<?php

namespace MyApp\EspritBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MenuType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('title')
         
                
                
         ->add('utilisateur', 'entity', array('class' => 'MyApp\EspritBundle\Entity\Utilisateur',     
          'property' => 'nom',
          'expanded' => false,
          'multiple' => false,
          'required' => true ) 
                
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\EspritBundle\Entity\Menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'myapp_espritbundle_menu';
    }
}
