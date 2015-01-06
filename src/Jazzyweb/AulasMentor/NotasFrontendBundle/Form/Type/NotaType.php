<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NotaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', 'text')
            ->add('texto', 'textarea')
            ->add('file', 'file');
    }

    public function getName()
    {
        return 'nota';
    }

    // Esto no es siempre necesario, pero para construir formularios embebidos
    // es imprescindibles, así que no cuesta nada acostumbrarse a ponerlo
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota',
        );
    }

}