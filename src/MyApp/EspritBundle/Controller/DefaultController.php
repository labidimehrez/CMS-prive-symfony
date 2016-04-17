<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('MyAppEspritBundle::layout.html.twig');
    }

    public function administrationAction() {
        return $this->render('MyAppEspritBundle:Default:administration.html.twig');
        }

        
        
    public function choisirLangueAction($langue = null){
        if($langue != null)
        {
        $this->container->get('request')->setLocale($langue);
        }
        $url = $this->container->get('request')->headers->get('referer');
        if (empty($url)) {
            $url = $this->container->get('router')->generate('my_app_esprit_top');
        }
        return new \Symfony\Component\HttpFoundation\RedirectResponse($url);
        
 
    }

 
    
}

