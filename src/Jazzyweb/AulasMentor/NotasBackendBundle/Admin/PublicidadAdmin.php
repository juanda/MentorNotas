<?php

namespace Jazzyweb\AulasMentor\NotasBackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PublicidadAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('nombre')
            ->add('texto')
            ->add('path', null, array("read_only" => true))
            ->add('file', 'file', array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('nombre')
            ->add('texto')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->add('imagen', null, array('template' => 'JAMNotasBackendBundle:Sonata:imagen.html.twig'))
            ->addIdentifier('nombre')
            ->add('texto')
            ->add('path')
        ;
    }

    public function prePersist($object)
    {
        $object->upload();
    }

    public function preUpdate($object)
    {
        $object->upload();
    }

    public function postRemove($object)
    {
        $object->removeUpload();
    }

}