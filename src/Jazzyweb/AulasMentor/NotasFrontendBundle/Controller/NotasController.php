<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotasController extends Controller
{

    public function indexAction()
    {
        $request = $this->getRequest(); // equivalente a $this->get('request');
        $session = $request->getSession();

        $ruta = $request->get('_route');

        switch ($ruta)
        {
            case 'jamn_homepage':

                break;

            case 'jamn_conetiqueta':
                $session->set('busqueda.tipo', 'por_etiqueta');
                $session->set('busqueda.valor', $request->get('etiqueta'));
                $session->set('nota.seleccionada.id', '');

                break;

            case 'jamn_buscar':
                $session->set('busqueda.tipo', 'por_termino');
                $session->set('busqueda.valor', $request->get('termino'));
                $session->set('nota.seleccionada.id', '');

                break;
            case 'jamn_nota':
                $session->set('nota.seleccionada.id', $request->get('id'));

                break;
        }

        list($etiquetas, $notas, $nota_seleccionada) = $this->dameEtiquetasYNotas();

        return $this->render('JAMNotasFrontendBundle:Notas:index.html.twig', array(
            'etiquetas' => $etiquetas,
            'notas' => $notas,
            'nota_seleccionada' => $nota_seleccionada,
        ));
    }

    public function nuevaAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->getMethod() == 'POST') {

            // si los datos que vienen en la request son buenos guarda la nota

            $session
                ->getFlashBag()->add('mensaje', 'Se debería guardar la nota:'
                    . $request->get('nombre') .
                    '. Como aun no disponemos de un servicio para
                          persistir los datos, mostramos la nota 1');

            return
                $this
                    ->redirect($this->generateUrl('jamn_nota', array('id' => 1)));
        }

        list($etiquetas, $notas, $nota_seleccionada) = $this->dameEtiquetasYNotas();

        return $this->render('JAMNotasFrontendBundle:Notas:nueva.html.twig',
            array(
                'etiquetas' => $etiquetas,
                'notas' => $notas,
                'nota_seleccionada' => $nota_seleccionada,
            )
        );
    }

    public function editarAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // Se recupera la nota que viene en la request para ser editada

        $nota = array(
            'id' => $request->get('id'),
            'titulo' => 'nota',
        );


        if ($request->getMethod() == 'POST') {

            // si los datos que vienen en la request son buenos guarda la nota

            $session->getFlashBag()->add('mensaje', 'Se debería editar la nota:'
                . $request->get('titulo') .
                '. Como aún no disponemos de un servicio para persistir los
                         datos, la nota permanece igual');

            return $this->redirect(
                $this->generateUrl('jamn_nota',
                    array('id' => $request->get('id'))
                )
            );
        }

        list($etiquetas, $notas, $nota_seleccionada) = $this->dameEtiquetasYNotas();

        return $this
            ->render('JAMNotasFrontendBundle:Notas:editar.html.twig',
                array(
                    'etiquetas' => $etiquetas,
                    'notas' => $notas,
                    'nota_a_editar' => $nota,
                ));
    }

    public function borrarAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // borrado de la nota $request->get('id');

        $session->getFlashBag()->add('mensaje',
            'Se debería borrar la nota ' . $request->get('id'));

        $session->set('nota.seleccionada.id', '');

        return $this->forward('JAMNotasFrontendBundle:Notas:index');
    }

    public function miEspacioAction()
    {
        $params = 'Los datos de la página de inicio del espacio premium';
        return
            $this
                ->render(
                    'JAMNotasFrontendBundle:Notas:index',
                    array('params' => $params)
                );
    }

    public function rssAction()
    {

    }

    protected function dameEtiquetasYNotas()
    {
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $busqueda_tipo = $session->get('busqueda.tipo');

        $busqueda_valor = $session->get('busqueda.valor');

        // Etiquetas. Se pillan todas
        $etiquetas = $em->getRepository('JAMNotasFrontendBundle:Etiqueta')->
        findByUsuarioOrderedByTexto($usuario);

        // Notas. Se pillan según el filtro almacenado en la sesión
        if ($busqueda_tipo == 'por_etiqueta' && $busqueda_valor != 'todas') {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
            findByUsuarioAndEtiqueta($usuario, $busqueda_valor);
        } elseif ($busqueda_tipo == 'por_termino') {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
            findByUsuarioAndTermino($usuario, $busqueda_valor);
        } else {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
            findByUsuarioOrderedByFecha($usuario);
        }


        $nota_selecionada_id = $session->get('nota.seleccionada.id','1');

        $nota_seleccionada = $em
            ->getRepository('JAMNotasFrontendBundle:Nota')
            ->findOneById($nota_selecionada_id);


        return array($etiquetas, $notas, $nota_seleccionada);
    }
}