<?php

namespace App\Controller;

use Awurth\Slim\Helper\Controller\Controller;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $credentials = [
                'email' => $request->getParam('email'),
                'password' => $request->getParam('password')
            ];
            $remember = $request->getParam('remember') ? true : false;

            try {
                if ($this->auth->authenticate($credentials, $remember)) {
                    $this->flash('success', 'You are now logged in.');

                    return $this->redirect($response, 'showListAppelOffre');
                } else {
                    $this->validator->addError('auth', 'Bad email or password');
                }
            } catch (ThrottlingException $e) {
                $this->validator->addError('auth', 'Too many attempts!');
            }
        }

        return $this->twig->render($response, 'auth/login.twig');
    }

    public function register(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $email = $request->getParam('email');
            $password = $request->getParam('password');
            $siret = $request->getParam('siret');
            $siege_social = $request->getParam('siege_social');
            $chiffre_affaire = $request->getParam('chiffre_affaire');

            $this->validator->request($request, [
                'email' => V::noWhitespace()->email(),
                'password' => [
                    'rules' => V::noWhitespace()->length(6, 25),
                    'messages' => [
                        'length' => 'The password length must be between {{minValue}} and {{maxValue}} characters'
                    ]
                ],
                'password_confirm' => [
                    'rules' => V::equals($password),
                    'messages' => [
                        'equals' => 'Passwords don\'t match'
                    ]
                ],
                'siret' => [
                    'rules' => V::numeric(),
                    'messages' => [
                        'equals' => 'Siret not numeric'
                    ]
                ],
                'siege_social' => [
                    'rules' => V::alpha(),
                    'messages' => [
                        'equals' => 'Siege social is an adress'
                    ]
                ],
                'chiffre_affaire' => [
                    'rules' => V::numeric(),
                    'messages' => [
                        'equals' => 'Chiffre d\'affaire not numeric'
                    ]
                ]
            ]);

            if ($this->auth->findByCredentials(['login' => $email])) {
                $this->validator->addError('email', 'This email is already used.');
            }

            if ($this->auth->findByCredentials(['login' => $email])) {
                $this->validator->addError('email', 'This email is already used.');
            }

            if ($this->validator->isValid()) {
                $role = $this->auth->findRoleByName('User');

                $user = $this->auth->registerAndActivate([
                    'email' => $email,
                    'password' => $password,
                    'siret' => $siret,
                    'siege_social' => $siege_social,
                    'chiffre_affaire' => $chiffre_affaire,
                    'permissions' => [
                        'user.delete' => 0
                    ]
                ]);

                $role->users()->attach($user);

                $this->flash('success', 'Your account has been created.');

                return $this->redirect($response, 'login');
            }
        }

        return $this->twig->render($response, 'auth/register.twig');
    }

    public function logout(Request $request, Response $response)
    {
        $this->auth->logout();

        return $this->redirect($response, 'home');
    }
}
