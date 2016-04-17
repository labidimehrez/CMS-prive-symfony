<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Utilisateur;
use MyApp\EspritBundle\Form\UtilisateurType;



class UtilisateurController extends Controller
{
    
    
    
    public function sendAction()
    {
        
        $utilisateur = new Menu();
        $form = $this->createForm(new UtilisateurType , $utilisateur);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $utilisateur = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($utilisateur);
               $em->flush();
               return $this->redirect($this->generateUrl('my_app_esprit_utilisateur_show'));
               }
        }
        
       return $this->render('MyAppEspritBundle:Utilisateur:send.html.twig',array('form'=>$form->createView())); 
    }
    
    
    /**
     * Show a Menu entry
     */
    public function showAction()
    {
         $em = $this->getDoctrine()->getManager();

        $utilisateur= $em->getRepository('MyAppEspritBundle:Utilisateur')->findAll();

        return $this->render('MyAppEspritBundle:Utilisateur:show.html.twig', array(
            'utilisateur' => $utilisateur,
        ));
    }
    
    
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('MyAppEspritBundle:Utilisateur')->find($id);

        if (!$utilisateur) {
            throw $this->createNotFoundException('No Utilisateur found for id '.$id);
        }

        $em->remove($utilisateur);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_utilisateur_show'));
    }
    
    
    
    
    
    
    
    public function editAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $utilisateur = $em->getRepository('MyAppEspritBundle:Utilisateur')->find($id);
    if (!$utilisateur) {
      throw $this->createNotFoundException(
              'No Utilisateur found for id ' . $id
      );
    }
    
    $form = $this->createFormBuilder($utilisateur)
        
        
            ->add('nom', 'text')
            ->add('login', 'text') 
            ->add('password', 'text')
            ->add('mail', 'text')
            
        ->add('role','entity',array('class'=>'MyApp\EspritBundle\Entity\Role','property'=>'id'))
        
        ->getForm();

    $form->handleRequest($request);
 

    if ($form->isValid()) {
        $em->flush();
       return $this->redirect($this->generateUrl('my_app_esprit_utilisateur_show'));
    }
                            
       return $this->render('MyAppEspritBundle:Utilisateur:edit.html.twig',array('form'=>$form->createView())); 
    }
     
 
}

    
    
    
    
    
    
    
 
