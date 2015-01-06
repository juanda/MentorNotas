<?php

namespace Jazzyweb\AulasMentor\NotasBackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TarifaAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('nombre')
            ->add('periodo')
            ->add('precio')
            ->add('validoDesde')
            ->add('validoHasta')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nombre')
            ->add('periodo')
            ->add('precio')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('nombre')
            ->add('periodo')
            ->add('precio')
            ->add('validoDesde')
            ->add('validoHasta')
        ;
    }
}