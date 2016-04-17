<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MyApp\EspritBundle\Entity\Article;
use MyApp\EspritBundle\Form\ArticleType;

class ArticleController extends Controller {

    
    
     public function newAction()
    {
        $article = new Article();
        //$entity = $em->getRepository('CliniqueGynecoBundle:Article');
        $form   = $this->createForm(new ArticleType(), $article);
 
        return $this->render('MyAppEspritBundle:Article:send.html.twig', array(
            'article' => $article,
            'form'   => $form->createView()
        ));
    }
 
     public function sendAction() {

        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {

            $form->bind($request);

            if ($form->isValid()) {
                $article = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                
                return $this->redirect($this->generateUrl('my_app_esprit_article_show'));
            }
            
        }

        return $this->render('MyAppEspritBundle:Article:send.html.twig', array('form' => $form->createView()));
    }
 
   
 
    /**
     * Show a Article entry
     */
    public function showAction() {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('MyAppEspritBundle:Article')->findBy(array(), array('date'=>'asc'));

        return $this->render('MyAppEspritBundle:Article:show.html.twig', array(
                    'article' => $article,
        ));
    }
    
   
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MyAppEspritBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('No Article found for id ' . $id);
        }

        /*  On teste que l'utilisateur dispose bien du rôle ROLE_ADMIN*/      
          if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
          return $this->redirect($this->generateUrl('fos_user_security_login'));
          }
        /**************** */
   
          
        $em->remove($article);
        $em->flush();
                         /********** FlashBag ****** */
         $this->get('session')->getFlashBag()->set('message', 'Cet article disparait !!'); 
                        /**************** */
        return $this->redirect($this->generateUrl('my_app_esprit_article_show'));
    }

    public function editAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MyAppEspritBundle:Article')->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                    'No Article found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($article)
                ->add('texte', 'text')
                ->add('image', 'text', array('required' => false))
                ->add('nom', 'text')
                ->add('date', 'date')
                ->add('role', 'entity', array(
                    'class' => 'MyApp\EspritBundle\Entity\Role',
                    'property' => 'permission',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true))
                ->add('sousrubrique', 'entity', array(
                    'class' => 'MyApp\EspritBundle\Entity\Sousrubrique',
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false))
                ->add('rubrique', 'entity', array(
                    'class' => 'MyApp\EspritBundle\Entity\Rubrique',
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('my_app_esprit_article_show'));
        }

        return $this->render('MyAppEspritBundle:Article:edit.html.twig', array('form' => $form->createView()));
    }

    public function topAction($max = 50) {
        $em = $this->container->get('doctrine')->getManager();


        /* recuperer article */
        $qb1 = $em->createQueryBuilder();
        $qb1->select('a')
                ->from('MyAppEspritBundle:Article', 'a')
                ->orderBy('a.date')
                ->setMaxResults($max);
        $query1 = $qb1->getQuery();
        $article = $query1->getResult();

        /* recuperer rubrique */
        $qb2 = $em->createQueryBuilder();
        $qb2->select('b')
                ->from('MyAppEspritBundle:Rubrique', 'b')
                ->orderBy('b.position')
                ->setMaxResults($max);
        $query2 = $qb2->getQuery();
        $rubrique = $query2->getResult();

        /* recuperer sousrubrique */
        $qb3 = $em->createQueryBuilder();
        $qb3->select('c')
                ->from('MyAppEspritBundle:Sousrubrique', 'c')
                ->orderBy('c.position')
                ->setMaxResults($max);
        $query3 = $qb3->getQuery();
        $sousrubrique = $query3->getResult();

        /* recuperer actualite */
        $qb4 = $em->createQueryBuilder();
        $qb4->select('c')
                ->from('MyAppEspritBundle:Actualite', 'c')
                ->orderBy('c.dateinsertion')
                ->setMaxResults($max);
        $query4 = $qb4->getQuery();
        $actualite = $query4->getResult();

        /* recuperer menu */
        $qb5 = $em->createQueryBuilder();
        $qb5->select('c')
                ->from('MyAppEspritBundle:Menu', 'c')
                ->orderBy('c.position')
                ->setMaxResults($max);
        $query5 = $qb5->getQuery();
        $menu = $query5->getResult();


        /* recuperer role */
        $qb6 = $em->createQueryBuilder();
        $qb6->select('c')
                ->from('MyAppEspritBundle:Role', 'c')
                ->orderBy('c.permission')
                ->setMaxResults($max);
        $query6 = $qb6->getQuery();
        $role = $query6->getResult();







        return $this->container->get('templating')
                        ->renderResponse('MyAppEspritBundle:Article:lister.html.twig', array(
                            'article' => $article,
                            'rubrique' => $rubrique,
                            'sousrubrique' => $sousrubrique,
                            'actualite' => $actualite,
                            'menu' => $menu,
                            'role' => $role,
        ));
    }

    public function showbyidAction($id) {
        $em = $this->getDoctrine()->getManager();

        $a = $em->getRepository('MyAppEspritBundle:Article')->find($id);
        /*         * ************** */
        /* recuperer article */
        $qb1 = $em->createQueryBuilder();
        $qb1->select('a')
                ->from('MyAppEspritBundle:Article', 'a')
                ->orderBy('a.date');
        $query1 = $qb1->getQuery();
        $article = $query1->getResult();
        /*         * ************************ */
        /* recuperer rubrique */
        $qb2 = $em->createQueryBuilder();
        $qb2->select('b')
                ->from('MyAppEspritBundle:Rubrique', 'b')
                ->orderBy('b.position');
        $query2 = $qb2->getQuery();
        $rubrique = $query2->getResult();

        /* recuperer sousrubrique */
        $qb3 = $em->createQueryBuilder();
        $qb3->select('c')
                ->from('MyAppEspritBundle:Sousrubrique', 'c')
                ->orderBy('c.position');
        $query3 = $qb3->getQuery();
        $sousrubrique = $query3->getResult();

        /* recuperer actualite */
        $qb4 = $em->createQueryBuilder();
        $qb4->select('c')
                ->from('MyAppEspritBundle:Actualite', 'c')
                ->orderBy('c.dateinsertion');
        $query4 = $qb4->getQuery();
        $actualite = $query4->getResult();

        /* recuperer menu */
        $qb5 = $em->createQueryBuilder();
        $qb5->select('c')
                ->from('MyAppEspritBundle:Menu', 'c')
                ->orderBy('c.position');
        $query5 = $qb5->getQuery();
        $menu = $query5->getResult();


        /* recuperer role */
        $qb6 = $em->createQueryBuilder();
        $qb6->select('c')
                ->from('MyAppEspritBundle:Role', 'c')
                ->orderBy('c.permission');
        $query6 = $qb6->getQuery();
        $role = $query6->getResult();

        /*         * ********* */

        if (!$article) {
            throw $this->createNotFoundException('Unable to find article entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);

        return $this->render('MyAppEspritBundle:Article:showbyid.html.twig', array(
                    'article' => $article,    
                    'a' => $a,
                    'rubrique' => $rubrique,
                    'sousrubrique' => $sousrubrique,
                    'actualite' => $actualite,
                    'menu' => $menu,
                    'role' => $role,
        ));
    }

}
