<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultEstatica extends AbstractController
{
    #[Route('/sitio/{pagina}', name: 'app_estatica', requeriments:['pagina'=>'patrocinadores|licencia|condiciones_uso.html|privacidad'])]
    public function estaticaAction($pagina) 
    {
        return $this->render('estatica/'.$pagina.'.html.twig');
    }
}