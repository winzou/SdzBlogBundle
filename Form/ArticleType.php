<?php

namespace Sdz\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('titre')
            ->add('contenu')
        ;
    }

    public function getName()
    {
        return 'sdz_blogbundle_articletype';
    }
}
