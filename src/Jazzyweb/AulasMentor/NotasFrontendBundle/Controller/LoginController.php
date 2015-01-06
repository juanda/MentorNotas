<?php
namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type\RegistroType;

class LoginController extends Controller
{

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'JAMNotasFrontendBundle:Login:login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
            )
        );
    }

    public function registroAction() {

        $request = $this->getRequest();
        $usuario = new Usuario();

        $form = $this->createForm(new RegistroType(), $usuario);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $serviceRegistro = $this->get('jam_notas_frontend.registro');
            $serviceRegistro->registra($usuario, $form->get('password')->getData());

            return $this
                ->render(
                    'JAMNotasFrontendBundle:Login:registro_success.html.twig',
                    array('usuario' => $usuario)
                );
        }

        return $this
            ->render(
                'JAMNotasFrontendBundle:Login:registro.html.twig',
                array('form' => $form->createView())
            );
    }

    public function activarAction()
    {
        $request = $this->getRequest();

        $em = $this->get('doctrine')->getManager();

        $usuario = $em->getRepository('JAMNotasFrontendBundle:Usuario')
            ->findOneByTokenRegistro($request->get('token'));

        if (!$usuario) {
            throw $this->createNotFoundException('Usuario no registrado');
        }

        $usuario->setIsActive(true);
        $em->persist($usuario);

        $em->flush();

        return $this
            ->render(
                'JAMNotasFrontendBundle:Login:activar_success.html.twig',
                array('usuario' => $usuario)
            );
    }
}