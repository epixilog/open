<?php

namespace OC\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
	public $adverts = array(
    						1 => array(
    									'id'	=> 1,
    									'title'	=> 'PHP/MYSQL',
    									'author'=> 'Sensio Lab',
    									'description'=> 'Sensio lab recherche un développeur PHP avec de bonne connaissance MYSQL',
    									'date'	=> '2016-08-02 00:00:00'
    								),
    						2 => array(
    									'id'	=> 2,
    									'title'	=> 'C++',
    									'author'=> 'IBM',
    									'description'=> 'Nous cherchons un dévloppeur expérimenté en C++ (POO)',
    									'date'	=> '2016-08-01 00:00:00'
    								),
    						3 => array(
    									'id'	=> 3,
    									'title'	=> 'COBOL',
    									'author'=> 'IBM',
    									'description'=> 'Vous développez en COBOL? Nous avons un très bon job pour vous!',
    									'date'	=> '2016-09-02 00:00:00'
    								)
    				);

    public function indexAction()
    {
        return $this->render('OCPlateformBundle:Advert:index.html.twig', array(
        											'adverts' => $this->adverts
        		));
    }


    public function viewAction($id, Request $r)
    {	
    	$advert = $this->adverts[$id];

    	return $this->render('OCPlateformBundle:Advert:view.html.twig', array('advert'=>$advert));
    }

    public function addAction(Request $request)
    {	
    	if($request->isMethod('POST'))
    	{
    			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistré.');

    			return $this->redirectToRoute('oc_platform_view', array( 'id' => 5 ));
    	}

    	return $this->render('OCPlateformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
    	$advert = $this->adverts[$id];

    	if($request->isMethod('POST'))
    	{
    			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistré.');

    			return $this->redirectToRoute('oc_platform_view', array( 'id' => $advert['id'] ));
    	}

    	return $this->render('OCPlateformBundle:Advert:edit.html.twig', array( 'advert'=>$advert ));
    }

    public function deleteAction($id)
    {
    	return $this->render('OCPlateformBundle:Advert:delete.html.twig', array('id'=>$id));
    }

    public function menuAction()
    {
    	// On fixe en dur une liste ici, bien entendu par la suite
		    // on la récupérera depuis la BDD !
		    $listAdverts = array(
		      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
		      array('id' => 5, 'title' => 'Mission de webmaster'),
		      array('id' => 9, 'title' => 'Offre de stage webdesigner')
		    );

		    return $this->render('OCPlateformBundle:Advert:menu.html.twig', array(
		      // Tout l'intérêt est ici : le contrôleur passe
		      // les variables nécessaires au template !
		      'listAdverts' => $listAdverts
		    ));
    }

}
