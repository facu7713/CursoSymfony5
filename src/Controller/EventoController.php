<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Evento;
use App\Repository;

class EventoController extends AbstractController
{
    /**
     * @Route("/eventos", name="app_eventos_listar")
     */
    public function EventosAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $eventos = $em->getRepository(Evento::class)->findEventosAlfabeticamente();
        return $this->render('evento\eventos.html.twig' , ['eventos'=>$eventos]);
    }

    /**
     * @Route("/evento/{slug}", name="app_evento")
     */
    public function EventoAction($slug): Response
    {
        $em = $this->getDoctrine()->getManager(); 
        $evento = $em->getRepository(Evento::class)->findOneBy(array( 
            'slug'=>$slug
        ));
        
        if(!$evento){
            throw $this->createNotFoundException('No existe el evento solicitado');
        }

        return $this->render('evento/evento.html.twig', [
            'evento' => $evento
        ]);
    }
}

