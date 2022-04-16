<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class HotelController extends AbstractController
{
    /**
     * @Route("/hotel", name="hotel")
     */
   
    public function index(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
       // $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
       // echo $jsonContent;
        return $this->render('hotel/index.html.twig',
    array('hoteles' => $hoteles));
    }
}
