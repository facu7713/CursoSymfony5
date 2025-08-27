<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evento;

/**
* @Route("/admin")
*/

class AdminEventoController extends AbstractController
{
    /**
     * @Route("/evento/listar", name="app_admin_evento_listar")
     */
    public function listarAction(){
        $em = $this->getDoctrine()->getManager();
        $eventos = $em->getRepository(Evento::class)->findEventosAlfabeticamente();
        return $this->render('adminEvento\eventos.html.twig' , ['eventos'=>$eventos]);
    }
}
