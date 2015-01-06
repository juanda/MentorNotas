<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsuarioType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text')
            ->add('apellidos', 'text')
            ->add('email', 'email')
            ->add('isActive', 'checkbox')
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('guardar', 'submit', array('label' => 'Guardar'))
        ;
    }

    public function getName()
    {
        return 'usuario';
    }

    // Esto no es siempre necesario, pero para construir formularios embebidos
    // es imprescindibles, así que no cuesta nada acostumbrarse a ponerlo
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario',
        );
    }
}