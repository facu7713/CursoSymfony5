<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Disertante;
use App\Repository\DisertanteRepository;

class DisertanteController extends AbstractController
{
    /**
     * @Route("/disertantes", name="app_disertantes_listar")
     */
    public function disertantesAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $disertantes = $em->getRepository(Disertante::class)->findDisertantesAlfabeticamente();
        return $this->render('disertante\disertantes.html.twig' , ['disertantes'=>$disertantes]);
    }
    /**
     * @Route("/disertante/{id}", name="app_disertante")
     */
    public function disertanteAction($id): Response
    {
        $em = $this->getDoctrine()->getManager(); 
        $disertante = $em->getRepository(Disertante::class)->findOneBy(array( 
            'id'=>$id
        ));
        
        if(!$disertante){
            throw $this->createNotFoundException('No tiene eventos este disertantes');
        }

        return $this->render('disertante/disertante.html.twig', [
            'disertante' => $disertante
        ]);
    }
}


