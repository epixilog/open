<?php

namespace OC\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCPlateformBundle:Default:index.html.twig');
    }

    public function helloAction($who)
    {
    	return $this->render('OCPlateformBundle:Default:hello.html.twig',array('who'=>$who));
    }
}
