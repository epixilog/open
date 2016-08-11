<?php

namespace OC\PlateformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use OC\PlateformBundle\Entity\Advert;
use OC\PlateformBundle\Entity\Application;
use OC\PlateformBundle\Entity\Category;
use OC\PlateformBundle\Entity\Image;

class LoadAdvertData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	$categories = array(
    						0 => "Informatique",
    						1 => "Médecine",
    						2 => "Industriel"
    					);

    	$cats = array();

    	$image1 = new Image();
    	$image1->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    	$image1->setAlt('job-de-reve');

    	$image2 = new Image();
    	$image2->setUrl('https://download-codeplex.sec.s-msft.com/Download?ProjectName=phpexcel&DownloadId=65397&Build=21031');
    	$image2->setAlt('autre-job-de-reve');

    	foreach($categories as $c)
    	{
    		$category = new Category();
    		$category->setName($c);

    		array_push($cats, $category);
    	}
    	
    	$advert = new Advert();
    	$advert->setTitle('Developpeur PHP');
    	$advert->setAuthor('Sensio lab');
    	$advert->setContent('Vous êtes amené à réaliser des projets PHP avec une précision d\'expert');
    	$advert->setImage($image2);
    	$advert->addCategory($cats[0]);
    	$advert->addCategory($cats[2]);


    	$manager->persist($advert);

    	$advert = new Advert();
    	$advert->setTitle('Médecin pédé');
    	$advert->setAuthor('Insane Health');
    	$advert->setContent('Vous êtes amené à faire des pipes à nos patients');
    	$advert->setImage($image1);
    	$advert->addCategory($cats[1]);

    	$manager->persist($advert);

        $manager->flush();
    }
}