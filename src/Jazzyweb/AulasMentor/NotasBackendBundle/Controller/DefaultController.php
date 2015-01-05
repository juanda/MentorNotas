<?php

namespace Jazzyweb\AulasMentor\NotasBackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JAMNotasBackendBundle:Default:index.html.twig', array('name' => $name));
    }
}
