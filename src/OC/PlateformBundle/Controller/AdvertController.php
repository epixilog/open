<?php

namespace OC\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCPlateformBundle:Default:index.html.twig');
    }


    public function viewAction($id)
    {	
    	var_dump($id); die();
    }

    public function viewSlugAction($year,$slug,$_format)
    {	
    	var_dump($year.'-'.$slug.'-'.$_format);
    }

    public function add()
    {
    	
    }
}
