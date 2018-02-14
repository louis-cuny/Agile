<?php

$app->get('/', 'app.controller:home')->setName('home');


$app->group('', function () {
    $this->map(['GET', 'POST'], '/login', 'auth.controller:login')->setName('login');
    $this->map(['GET', 'POST'], '/register', 'auth.controller:register')->setName('register');
})->add($container['guest.middleware']);

$app->get('/logout', 'auth.controller:logout')
    ->add($container['auth.middleware']())
    ->setName('logout');

$app->post('/confirmAppelOffre', 'appel.controller:confirmAppelOffre')->setName('confirmAppelOffre');
$app->get('/addAppelOffre', 'appel.controller:addAppelOffre')->setName('addAppelOffre');
$app->get('/listAppeloffre', 'appel.controller:showListAppelOffre')->setName('showListAppelOffre');
$app->get('/appelOffre/{id}', 'appel.controller:showAppelOffre')->setName('showAppelOffre');
$app->get('/inscriptionOffre', 'appel.controller:inscriptionAppelOffre')->setName('inscriptionOffre');

$app->get('/user/{id}', 'user.controller:showUser')->setName('user');
