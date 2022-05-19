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
     * @Route("", name="app_home",methods={"GET","HEAD"})
     */
   
    public function Home(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        
       // $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
       // echo $jsonContent;
        return $this->render('Home/index.html.twig',
    array('hoteles' => $hoteles));
    }





    /**
     * @Route("/explore", name="explore",methods={"GET","HEAD"})
     */
   
    public function index(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        
       // $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
       // echo $jsonContent;
        return $this->render('Home/explore.html.twig',
    array('hoteles' => $hoteles));
    }





    /**
     * @Route("/s/{name}/explore", name="RegionExplore",methods={"GET","HEAD"})
     */
   
    public function index2(ManagerRegistry $doctrine,SerializerInterface $serializer,string $name): Response
    {
        $alojamientos=[];
        $ubicaciones=$doctrine->getRepository(Ubicaciones::class)->findBy(array('comunidad' => $name));

        foreach($ubicaciones as $ubicacion){

            $alojamiento=$doctrine->getRepository(Hotel::class)->find($ubicacion);
            
            array_push($alojamientos,$alojamiento);
        }
      
        
       // $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
       // echo $jsonContent;
        return $this->render('Home/RegionExplore.html.twig',
    array('alojamientos' => $alojamientos));
    }
}
