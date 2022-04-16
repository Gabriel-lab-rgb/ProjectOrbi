<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AlojamientoController extends AbstractController
{
    /**
     * @Route("/alojamiento/{alojamiento}", name="alojamiento")
     */
    public function index(): Response
    {
        return $this->render('alojamiento/index.html.twig', [
            'controller_name' => 'AlojamientoController',
        ]);
    }
}
