<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type\UsuarioType;

class EstudioValidacionYFormularioController extends Controller
{

    public function validaUsuarioAction()
    {
        $usuario1 = new Usuario();

        // Primero validamos un usuario sin propiedades

        $validator = $this->get('validator');

        $errors1 = $validator->validate($usuario1);

        // Vemos que la única propiedad que ha pasado es Apellidos
        // Rellenamos las demás:
        $usuario2 = new Usuario();

        $usuario2->setNombre('Alberto Pablo');
        $usuario2->setEmail('albertopablo');
        $usuario2->setIsActive(10.23);
        $usuario2->setSalt('lasalt');
        $usuario2->setUsername('alberto pablo');
        $usuario2->setPassword('alberto pablo');

        $errors2 = $validator->validate($usuario2);

        //Pasó la propiedad nombre y salt

        $usuario3 = new Usuario();

        $usuario3->setNombre('Alberto Pablo');
        $usuario3->setEmail('albertopablo@kk.es');
        $usuario3->setIsActive(true);
        $usuario3->setSalt('lasalt');
        $usuario3->setUsername('albertopablo');
        $usuario3->setPassword('albertopablo');

        $errors3 = $validator->validate($usuario3);

        $usuarios = array(
            array('num' => 1, 'user' => $usuario1, 'errors' => $errors1),
            array('num' => 2, 'user' => $usuario2, 'errors' => $errors2),
            array('num' => 3, 'user' => $usuario3, 'errors' => $errors3),
        );

        return $this->render(
            'JAMNotasFrontendBundle:EstudioValidacionYFormulario:validaUsuario.html.twig',
            array('usuarios' => $usuarios));
    }

    public function formUsuarioAction()
    {
//        $usuario = new Usuario();
//
//        $usuario->setNombre('Alberto');
//        $usuario->setApellidos('Einstein');
//        $usuario->setEmail('albertopablo@kk.es');
//        $usuario->setIsActive(true);
//        $usuario->setUsername('alberto');
//        $usuario->setPassword('alberto');
//
//        $form = $this->createFormBuilder($usuario)
//            ->setAction($this->generateUrl('jamn_evf_form_usuario'))
//            ->setMethod('POST')
//            ->add('nombre', 'text')
//            ->add('apellidos', 'text')
//            ->add('email', 'email')
//            ->add('isActive', 'checkbox')
//            ->add('username', 'text')
//            ->add('password', 'password')
//            ->add('guardar', 'submit', array('label' => 'Guardar'))
//            ->getForm();
//
//        return $this->render(
//            'JAMNotasFrontendBundle:EstudioValidacionYFormulario:formUsuario.html.twig',
//            array('form' => $form->createView())
//        );

//        $usuario = new Usuario();
//
//        $usuario->setNombre('Alberto');
//        $usuario->setApellidos('Einstein');
//        $usuario->setEmail('albertopablo@kk.es');
//        $usuario->setIsActive(true);
//        $usuario->setUsername('alberto');
//        $usuario->setPassword('alberto');
//
//        $form = $this->createForm(new UsuarioType(), $usuario);
//
//        return
//            $this
//                ->render(
//                    'JAMNotasFrontendBundle:EstudioValidacionYFormulario:formUsuario.html.twig',
//                    array('form' => $form->createView())
//                );

        $request = $this->getRequest();
        $usuario = new Usuario();

        $form = $this->createForm(new UsuarioType(), $usuario);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            // Se procesa el formulario
            $this
                ->get('session')
                ->getFlashBag()->add('mensaje','El formulario era válido');

            return
                $this
                    ->redirect($this->generateUrl('jamn_evf_form_usuario'));
        }

        return $this->render(
            'JAMNotasFrontendBundle:EstudioValidacionYFormulario:formUsuario.html.twig',
            array('form' => $form->createView())
        );
    }

}
