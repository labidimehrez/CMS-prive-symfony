<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Actualite;
use MyApp\EspritBundle\Form\ActualiteType;



class ActualiteController extends Controller
{

    public function sendAction()
    {
        
        $actualite = new Actualite();
        $form = $this->createForm(new ActualiteType , $actualite);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $actualite = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($actualite);
               $em->flush();
               
               
               
               return $this->redirect($this->generateUrl('my_app_esprit_actualite_show'));
               }
        }
        
       return $this->render('MyAppEspritBundle:Actualite:send.html.twig',array('form'=>$form->createView())); 
    }
    
    
    /**
     * Show a Actualite entry
     */
    public function showAction()
    {
         $em = $this->getDoctrine()->getManager();

        $actualite = $em->getRepository('MyAppEspritBundle:Actualite')->findAll();

        return $this->render('MyAppEspritBundle:Actualite:show.html.twig', array(
            'actualite' => $actualite,
        ));
    }
    
    
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $actualite = $em->getRepository('MyAppEspritBundle:Actualite')->find($id);

        if (!$actualite) {
            throw $this->createNotFoundException('No Actualite found for id '.$id);
        }

        $em->remove($actualite);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_actualite_show'));
    }
    
    
    
    
    
    
    
    public function editAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $actualite = $em->getRepository('MyAppEspritBundle:Actualite')->find($id);
    if (!$actualite) {
      throw $this->createNotFoundException(
              'No Actualite found for id ' . $id
      );
    }
    
    $form = $this->createFormBuilder($actualite)
            
        ->add('titre', 'text')
        ->add('dateinsertion', 'date')
        ->add('description', 'text')
        ->add('image', 'text',array('required' => false))   
            
        ->add('utilisateur','entity',array('class'=>'MyApp\EspritBundle\Entity\Utilisateur','property'=>'nom'))
        
        ->getForm();

    $form->handleRequest($request);
 
    if ($form->isValid()) {
        $em->flush();
       return $this->redirect($this->generateUrl('my_app_esprit_actualite_show'));
    }
                            
       return $this->render('MyAppEspritBundle:Actualite:edit.html.twig',array('form'=>$form->createView())); 
    }
     
 
}
