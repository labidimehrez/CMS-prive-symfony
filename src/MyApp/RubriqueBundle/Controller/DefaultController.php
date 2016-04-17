<?php

namespace MyApp\RubriqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MyAppRubriqueBundle:Default:index.html.twig', array('name' => $name));
    }
}
