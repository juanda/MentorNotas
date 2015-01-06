<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Services;

class Registro {

    private $em; // El entity manager de doctrine
    private $mailer;
    private $templating;
    private $factoryEncoder;

    public function __construct($em, $mailer, $templating,
                                $factoryEncoder) {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->factoryEncoder = $factoryEncoder;
    }

    public function registra($usuario, $password) {
        $usuario->setIsActive(false);
        $usuario->setTokenRegistro(substr(md5(uniqid(rand(), true)), 0, 32));

        $grupo = $this->em->getRepository('JAMNotasFrontendBundle:Grupo')
            ->findOneByRol('ROLE_REGISTRADO');

        $usuario->addGrupo($grupo);

        $encoder = $this->factoryEncoder->getEncoder($usuario);

        $salt = substr(md5(uniqid(rand(), true)), 0, 10);
        $usuario->setSalt($salt);
        $password = $encoder->encodePassword($password, $usuario->getSalt());

        $usuario->setPassword($password);

        $this->em->persist($usuario);

        $this->em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Alta en la aplicación MentorNotas')
            ->setFrom('noreplay@mentornotas.com')
            ->setTo($usuario->getEmail())
            ->setBody($this
                    ->templating
                    ->render(
                        'JAMNotasFrontendBundle:Login:email_registro.html.twig',
                        array('usuario' => $usuario)
                    )
            )
        ;
        $this->mailer->send($message);
    }
}