<?php

namespace App\Controller;

use Awurth\Slim\Helper\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Model\AppelOffre;
use Cartalyst\Sentinel\Sentinel;

class AppelOffreController extends Controller
{

  public function addAppelOffre(Request $request, Response $response)
  {
      return $this->twig->render($response, 'appelOffre/addAppelOffre.twig');
  }

  public function confirmAppelOffre(Request $request, Response $response) {
    // $offre = new AppelOffre;
		// $offre->intitule = $request->getParam('intitule');
		// $offre->commanditaire = $request->getParam('commanditaire');
    // $offre->adresse = $request->getParam('adresse');
    // $offre->ville = $request->getParam('ville');
    // $offre->email = $request->getParam('mail');
    // $offre->tel = $request->getParam('tel');
    // $offre->mission = $request->getParam('mission');
    // $offre->budget = $request->getParam('budget');
    // $offre->datelimitecandidature = $request->getParam('datelimitecandidature');
		// $offre->save();

    //Il reste a mettre le user_id
    var_dump($user = Sentinel::check());
    }

    public function showListAppelOffre(Request $request, Response $response){
      $list = AppelOffre::all();
      return $this->twig->render($response, 'appelOffre/index.twig', array('list'=>$list));
    }

}