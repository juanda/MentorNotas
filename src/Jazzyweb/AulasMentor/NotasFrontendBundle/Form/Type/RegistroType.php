<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text')
            ->add('apellidos', 'text')
            ->add('username', 'text')
            ->add('email', 'text')
            ->add('password', 'password')
            ->add('password_again', 'password');
    }

    public function getName()
    {
        return 'registro';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario',
        );
    }
}