<?php

namespace MyApp\EspritBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SousRubriqueType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('state', 'checkbox', array('required' => false,'data' => true)) 
            ->add('title')
            ->add('rubrique')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\EspritBundle\Entity\SousRubrique'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'myapp_espritbundle_sousrubrique';
    }
}