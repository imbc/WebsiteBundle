<?php

namespace Imbc\WebsiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultiSelectType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->setAttribute( 'widget', 'multiselect');
    }

    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults( array(
            'multiple' => true,
        ));
    }

    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'multiselect';
    }
}