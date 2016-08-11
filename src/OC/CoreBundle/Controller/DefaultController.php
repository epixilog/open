<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCCoreBundle:Default:index.html.twig');
    }

    public function contactAction()
    {
    	$this->addFlash(
            "notice",
            "La page de contact n'est pas encore disponible, merci de revenir en retard."
        );
        return $this->render('OCCoreBundle:Default:index.html.twig');
    }
}
