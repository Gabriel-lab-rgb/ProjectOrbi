<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Hotel;
use App\Entity\Regiones;
use App\Entity\Ubicaciones;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Contacto;
use App\Form\ContactoFormType;
use Symfony\Component\HttpFoundation\Request;

class HotelController extends AbstractController
{


 /**
     * @Route("/index", name="app_home",methods={"GET","HEAD"})
     */
   
    public function Home(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $alojamientos=$doctrine->getRepository(Hotel::class)->findAll(); 
        shuffle($alojamientos);
        
 
        
        return $this->render('Home/index.html.twig',
    array('alojamientos' => $alojamientos));
    }

/**
     * @Route("/contact", name="app_contact")
     */
   
    public function Contact(Request $request,ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        
        $contacto=new Contacto();
  

        $form = $this->createForm(ContactoFormType::class, $contacto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $contacto = $form->getData();
            $contacto->setUser($this->getUser());

            // ... perform some action, such as saving the task to the database

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($contacto);   

            $entityManager->flush();

            $this->addFlash(
                'notice',
                '¡Mensaje enviado con exito!'
            );
            return $this->redirectToRoute('app_contact');
        }
        return $this->render('Home/contact.html.twig',array('form'=>$form->CreateView()));
    }




    /**
     * @Route("/explore", name="explore",methods={"GET","HEAD"})
     */
   
    public function index(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        
      
        return $this->render('Home/explore.html.twig',
    array('hoteles' => $hoteles));
    }

   /**
     * @Route("/responseExplore",methods={"GET","HEAD"})
     */
   
    public function index3(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        
        $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
        return new Response($jsonContent);
    }




    /**
     * @Route("/s/{name}/explore", name="RegionExplore",methods={"GET","HEAD"})
     */
   
    public function index2(ManagerRegistry $doctrine,SerializerInterface $serializer,string $name): Response
    {
        $alojamientos=[];
        $region=$doctrine->getRepository(Regiones::class)->findOneBy(array('nombre' => $name));
       
        $ubicaciones=$doctrine->getRepository(Ubicaciones::class)->findBy(array('region' => $region));

        foreach($ubicaciones as $ubicacion){

            $alojamiento=$doctrine->getRepository(Hotel::class)->find($ubicacion);
            
            array_push($alojamientos,$alojamiento);
        }
      
        
       // $jsonContent = $serializer->serialize($hoteles, 'json',['groups' => 'hotel']);
       // echo $jsonContent;
        return $this->render('Home/RegionExplore.html.twig',
    array('alojamientos' => $alojamientos,'region'=> $region));
    }
}
