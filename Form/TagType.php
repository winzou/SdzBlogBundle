<?php

namespace Sdz\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('nom');
    }

    public function getName()
    {
        return 'sdz_blogbundle_tagtype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Sdz\BlogBundle\Entity\Tag',
        );
    }
}