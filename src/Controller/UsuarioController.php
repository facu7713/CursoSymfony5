<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuario;

class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuario", name="crear_usuario")
     */
    public function new(): Response
    {
        $usuario = new Usuario();
        $usuario->setNombre("Juan");
        $usuario->setApellidos("Pérez");
        $usuario->setDni("12345678");
        $usuario->setDireccion("Calle Falsa 123");
        $usuario->setTelefono("123456789");
        $usuario->setEmail("juan@example.com");
        $usuario->setPassword("clave123");

        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();

        return new Response("Usuario creado con éxito.");
    }
}

