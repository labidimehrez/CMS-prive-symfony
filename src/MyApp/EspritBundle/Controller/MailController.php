<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Mail;
use MyApp\EspritBundle\Form\MailType;

class MailController extends Controller {

    public function sendAction() {

      
        $Request = $this->getRequest();
        if ($Request->getMethod()== "POST")  {
       $Subject = $Request->get("Subject");
       $email = $Request->get("email");
       $message = $Request->get("message");

       $mailer =  $this->container->get('mailer');
       $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
            ->setUsername('mehrez.labidi@esprit.tn')
            ->setPassword('ak47ak47ak47');
       $mailer = \Swift_Mailer::newInstance( $transport ) ;     
       $message = \Swift_Message::newInstance( 'Test') 
       
                ->setSubject($Subject)
                ->setFrom('mehrez.labidi@esprit.tn')
                ->setTo($email)
                ->setBody($message);

        $this->get('mailer')->send($message);
        }
        return $this->render('MyAppEspritBundle:Default:administration.html.twig' );
    }

} 