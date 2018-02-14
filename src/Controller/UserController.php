<?php

namespace App\Controller;

use Awurth\Slim\Helper\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\AppelOffre;
use App\Model\User;
use Cartalyst\Sentinel\Sentinel;

class UserController extends Controller
{

  public function showUser(Request $request, Response $response, $args){
    $listUser = User::all();
    $user = $listUser->find($args);
    $listOffre = AppelOffre::all();
    $offres = $listOffre->where('user_id', '=', $args )->all();
    $res = array( 'offres'=> $offres, 'user'=> $user );
    return $this->twig->render($response, 'user/perso.twig', array('res' => $res));
  }
}
