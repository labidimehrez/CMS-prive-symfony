<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Sousrubrique;
use MyApp\EspritBundle\Form\SousrubriqueType;



class SousrubriqueController extends Controller
{
    
    
    
    public function sendAction()
    {
        
        $sousrubrique = new Sousrubrique();
        $form = $this->createForm(new SousrubriqueType , $sousrubrique);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $rubrique = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($sousrubrique);
               $em->flush();
               return $this->redirect($this->generateUrl('my_app_esprit_sousrubrique_show'));
               }
        }
        
       return $this->render('MyAppEspritBundle:Sousrubrique:send.html.twig',array('form'=>$form->createView())); 
    }
    
    
    /**
     * Show a Sousrubrique entry
     */
    public function showAction()
    {
         $em = $this->getDoctrine()->getManager();

        $sousrubrique = $em->getRepository('MyAppEspritBundle:Sousrubrique')->findAll();

        return $this->render('MyAppEspritBundle:Sousrubrique:show.html.twig', array(
            'sousrubrique' => $sousrubrique,
        ));
    }
    
    
    
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sousrubrique= $em->getRepository('MyAppEspritBundle:Sousrubrique')->find($id);

        if (!$sousrubrique) {
            throw $this->createNotFoundException('No Sousrubrique found for id '.$id);
        }
         /*  On teste que l'utilisateur dispose bien du rôle ROLE_ADMIN*/      
          if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
          return $this->redirect($this->generateUrl('fos_user_security_login'));
          }
        /**************** */
        $em->remove($sousrubrique);
        $em->flush();

        $this->get('session')->getFlashBag()->set('message', 'Ce sub rub disparait !!'); 

        
        return $this->redirect($this->generateUrl('my_app_esprit_sousrubrique_show'));
    }
    
    
    
    
    
    
    
    public function editAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $sousrubrique = $em->getRepository('MyAppEspritBundle:Sousrubrique')->find($id);
    if (!$sousrubrique) {
      throw $this->createNotFoundException(
              'No sousrubrique found for id ' . $id
      );
    }
    
    $form = $this->createFormBuilder($sousrubrique)
        
        ->add('position', 'integer')
        ->add('title', 'text')
        ->add('rubrique','entity',array('class'=>'MyApp\EspritBundle\Entity\Rubrique','property'=>'title'))
        ->add('state', 'checkbox', array('required' => false)) 
        ->getForm();

    $form->handleRequest($request);
 
   
    if ($form->isValid()) {
        $em->flush();
       return $this->redirect($this->generateUrl('my_app_esprit_sousrubrique_show'));
    }
                            
       return $this->render('MyAppEspritBundle:Sousrubrique:edit.html.twig',array('form'=>$form->createView())); 
    }
     
 
}
