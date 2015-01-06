<?php

namespace Jazzyweb\AulasMentor\NotasBackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UsuarioAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {

        $action = $this->getSubject() && !$this->getSubject()->getId() ? "Create" : "Edit";


        $formMapper
            ->add('nombre')
            ->add('apellidos')
            ->add('username')
            ->add('email')
            ->add('password', 'password')
            ->add('password_again', 'password')
        ;

        if($action == "Edit"){
            $formMapper->add('grupos', null, array('required' => false));
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nombre')
            ->add('apellidos')
            ->add('username')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('username')
            ->add('nombre')
            ->add('apellidos')
            ->add('isActive', null, array('editable' => true, 'label' => 'Activo'))
        ;
    }
}