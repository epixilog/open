<?php

namespace OC\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use OC\PlateformBundle\Entity\Advert;
use OC\PlateformBundle\Entity\Application;
use OC\PlateformBundle\Entity\Image;

class AdvertController extends Controller
{
    
    public function indexAction()
    {
        $adverts = $this->getDoctrine()->getRepository('OCPlateformBundle:Advert')->findAll();

        return $this->render('OCPlateformBundle:Advert:index.html.twig', array(
        											             'adverts' => $adverts
        		));
    }


    public function viewAction($id, Request $r)
    {	
    	$advert = $this->getDoctrine()->getRepository('OCPlateformBundle:Advert')->find($id);
        
    	return $this->render('OCPlateformBundle:Advert:view.html.twig', array('advert'=>$advert));
    }

    public function addAction(Request $request)
    {
        // Création de l'entité Advert
        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony2.');
        $advert->setAuthor('Alexandre');
        $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");

        // Création d'une première candidature
        $application1 = new Application();
        $application1->setAuthor('Marine');
        $application1->setContent("J'ai toutes les qualités requises.");

        // Création d'une deuxième candidature par exemple
        $application2 = new Application();
        $application2->setAuthor('Pierre');
        $application2->setContent("Je suis très motivé.");

        $application1->setAdvert($advert);
        $application2->setAdvert($advert);

        // Création de l'entité Image
        $image = new Image();
        $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        $image->setAlt('Job de rêve');

        // On lie l'image à l'annonce
        $advert->setImage($image);

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);

        $em->persist($application1);
        $em->persist($application2);

        // Étape 1 bis : si on n'avait pas défini le cascade={"persist"},
        // on devrait persister à la main l'entité $image
        // $em->persist($image);

        // Étape 2 : On déclenche l'enregistrement
        $em->flush();

    	if($request->isMethod('POST'))
    	{
    			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistré.');

    			return $this->redirectToRoute('oc_platform_view', array( 'id' => 5 ));
    	}

    	return $this->render('OCPlateformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
    	$advert = $this->getDoctrine()->getRepository('OCPlateformBundle:Advert')->find($id);

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
