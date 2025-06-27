<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        //var_dump('aca entro: ');exit;
        return $this->render('blog/index.html.twig', [
            'controller_nombre' => 'BlogController',
        ]);
    }
    #[Route('/ver/{id}', name: 'ver_post' , methods:['GET'])]
    public function verPost($id): reponse
    {
        return new reponse('listado'. $id);
    }
}
