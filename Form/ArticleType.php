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
			->add('pseudo')
			->add('tags', 'collection', array(
                'type'         => new TagType,
                'allow_add'    => true,
                'allow_delete' => true))
        ;
    }

    public function getName()
    {
        return 'sdz_blogbundle_articletype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Sdz\BlogBundle\Entity\Article',
        );
    }
}
