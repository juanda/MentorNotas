<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Doctrine\Common\Collections\ArrayCollection;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota;

class EstudioORMController extends Controller
{
    public function crearAction()
    {
        $nota1 = new Nota();
        $nota1->setFecha(new \DateTime());
        $nota1->setTitulo('Nota de prueba 1');
        $nota1->setTexto('Texto para la nota de pruebas 1');
        $nota1->setPath('ruta/a/nota1');

        $nota2 = new Nota();
        $nota2->setFecha(new \DateTime());
        $nota2->setTitulo('Nota de prueba 2');
        $nota2->setTexto('Texto para la nota de pruebas 2');
        $nota2->setPath('ruta/a/nota2');
        //Por lo pronto no le asociamos usuario
        // Ahora hay que persistirlo
        // solicitamos el servicio de persistencia (ORM)
        $em = $this->getDoctrine()->getManager();
        // Le enviamos a dicho servicio el objeto que queremos persistir (no se
        // realiza query aún
        $em->persist($nota1);
        $em->persist($nota2);

        // Al final del proceso, cuando hayamos enviado a todos los objetos
        // al servicio de persistencia, lo enviamos efectivamente a la base de
        // datos (insert)
        $em->flush();

        $notas = new ArrayCollection();

        $notas->add($nota1);
        $notas->add($nota2);

        return $this->render('JAMNotasFrontendBundle:EstudioORM:crear.html.twig',
            array('notas' => $notas));
    }

    public function recuperarAction()
    {
        $id = $this->getRequest()->get('id');

        $em = $this->getDoctrine()->getManager();

        $nota = $em->getRepository('JAMNotasFrontendBundle:Nota')->find($id);
        if (!$nota) {
            throw $this->createNotFoundException('No existe nota con id ' . $id);
        }


        return $this->render('JAMNotasFrontendBundle:EstudioORM:recuperar.html.twig',
            array('nota' => $nota));
    }

    public function recuperarNotasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->findAll();
        if (!$notas) {
            throw $this->createNotFoundException('No existen notas');
        }


        return
            $this->render(
                'JAMNotasFrontendBundle:EstudioORM:recuperarNotas.html.twig',
                array('notas' => $notas)
            );
    }

    public function dqlAction()
    {

//        $em = $this->getDoctrine()->getManager();
//
//        // Todas la notas usando DQL
//        $query = $em->createQuery(
//            'SELECT n FROM JAMNotasFrontendBundle:Nota n');
//
//        $notasTodas = $query->getResult();
//
//        return
//            $this
//                ->render(
//                    'JAMNotasFrontendBundle:EstudioORM:recuperarNotas.html.twig',
//                    array('notas' => $notasTodas)
//                );

//        $em = $this->getDoctrine()->getManager();
//        // Todas las notas que tienen en el título la palabra "ipsum" con DQL
//        $query = $em
//            ->createQuery(
//                "SELECT n FROM JAMNotasFrontendBundle:Nota n where n.texto LIKE :termino")
//            ->setParameter('termino', '%ipsum%');
//
//        $notasIpsum = $query->getResult();
//
//        return
//            $this->render(
//                'JAMNotasFrontendBundle:EstudioORM:recuperarNotas.html.twig',
//                array('notas' => $notasIpsum)
//            );
//
//        $em = $this->getDoctrine()->getManager();
//
//        // Todas las notas del usuario alberto con DQL
//        $query = $em
//            ->createQuery(
//                "SELECT n FROM JAMNotasFrontendBundle:Nota n JOIN  n.usuario u WHERE
//         u.username = :username")
//            ->setParameter('username', 'alberto');
//
//        $notasAlberto = $query->getResult();
//
//        return
//            $this
//                ->render(
//                    'JAMNotasFrontendBundle:EstudioORM:recuperarNotas.html.twig',
//                    array('notas' => $notasAlberto)
//                );


        $em = $this->getDoctrine()->getManager();
        // Todas la notas del usuario 'alberto' que tienen etiqueta 'php' con DQL
        $query = $em->createQuery(
            "SELECT n FROM JAMNotasFrontendBundle:Nota n
                      JOIN n.usuario u
                      JOIN  n.etiquetas e
                      WHERE e.texto = :texto AND u.username=:username")
            ->setParameters(array('texto' => 'php', 'username' => 'alberto'));

        $notasAlberto = $query->getResult();

        return
            $this
                ->render(
                    'JAMNotasFrontendBundle:EstudioORM:recuperarNotas.html.twig',
                    array('notas' => $notasAlberto)
                );

    }
}