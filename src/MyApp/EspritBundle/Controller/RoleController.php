<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Role;
use MyApp\EspritBundle\Form\RoleType;



class RoleController extends Controller
{
    
    
    
    public function sendAction()
    {
        
        $role = new Role();
        $form = $this->createForm(new RoleType , $role);
        $request = $this->getRequest();
        if( $request->isMethod('Post')  ){
            
           $form->bind($request);
           
           if($form->isValid())
               
               {
               $role = $form->getData();
               $em = $this->getDoctrine()->getManager();
               $em->persist($role);
               $em->flush();
               return $this->redirect($this->generateUrl('my_app_esprit_role_show'));
               }
        }
        
       return $this->render('MyAppEspritBundle:Role:send.html.twig',array('form'=>$form->createView())); 
    }
    
    
    /**
     * Show a Role entry
     */
    public function showAction()
    {
         $em = $this->getDoctrine()->getManager();

        $role = $em->getRepository('MyAppEspritBundle:Role')->findAll();

        return $this->render('MyAppEspritBundle:Role:show.html.twig', array(
            'role' => $role,
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository('MyAppEspritBundle:Role')->find($id);

        if (!$role) {
            throw $this->createNotFoundException('No Role found for id '.$id);
        }

        $em->remove($role);
        $em->flush();

        return $this->redirect($this->generateUrl('my_app_esprit_role_show'));
    }
    
    public function editAction($id, Request $request) {

    $em = $this->getDoctrine()->getManager();
    $role = $em->getRepository('MyAppEspritBundle:Role')->find($id);
    if (!$role) {
      throw $this->createNotFoundException(
              'No Role found for id ' . $id
      );
    }
    
    $form = $this->createFormBuilder($role)
        
        ->add('permission', 'checkbox')
         
        #->add('utilisateur','entity',array('class'=>'MyApp\EspritBundle\Entity\Utilisateur','property'=>'id'))
        ->add('permission', 'checkbox', array('required' => false)) 
        ->getForm();

    $form->handleRequest($request);
 
   
    if ($form->isValid()) {
        $em->flush();
       return $this->redirect($this->generateUrl('my_app_esprit_role_show'));
    }
                            
       return $this->render('MyAppEspritBundle:Role:edit.html.twig',array('form'=>$form->createView())); 
    }
     
 
}

    
    
 