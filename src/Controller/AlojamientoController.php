<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReservasFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Hotel;
use App\Entity\Reserva;
use App\Entity\PedidoReserva;




class AlojamientoController extends AbstractController
{
    /**
     * @Route("/alojamiento/{nombre}", name="alojamiento" ,methods={"GET","HEAD"})
     * 
     */
    public function index(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine,string $nombre): Response
    {
       
         $hotel=$doctrine->getRepository(Hotel::class)->findOneBy(array('Nombre'=> $nombre));
       
         
         $form = $this->createForm(ReservasFormType::class);
         
        

        return $this->render('alojamiento/index.html.twig', [
            'alojamiento' => $hotel, 'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/stays/{id}", name="stays")
     * 
     */

    public function stays(Request $request,int $id,EntityManagerInterface $entityManager,ManagerRegistry $doctrine,CartManager $cartManager): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        $precio=$hotel->getPrecio();


        
        $ite=$request->get('reservas_form');
        /*$salida=new \DateTime($formGet['salida']);
        $llegada=new \DateTime($formGet['llegada']);
        $comparacion=$salida->diff($llegada);
        $dias=$comparacion->days;
        $total= $precio*$dias;
        $reserva =new Reserva();*/
        $form = $this->createForm(ReservasFormType::class);
        $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
       
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
       /* $fecha = new \DateTime();
        $usuario=$this->getUser();
        $reserva->setUser($usuario);
        $reserva->setFecha($fecha);
        $reserva->setHotel($hotel);
        $reserva->setTotal($total);
     
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($reserva);   
        $entityManager->flush();*/

        $item=$form->getData();
        $item->setAlojamiento($hotel);

        $cart = $cartManager->getCurrentCart();
        $cart
            ->addItem($item)
            ->setUpdateAt(new \DateTime())
            ->setUsuario($this->getUser());
        $cartManager->save($cart);

         return $this->redirectToRoute('confirmacion');
       }
 

        return $this->render('alojamiento/stays.html.twig',['precio'=>$precio/*'dias'=>$dias'total'=> $total,*/ ,  'alojamiento' =>$hotel,'form' => $form->createView(),'formGet' => $ite]);
    }

     /**
     * @Route("/confirmacion", name="confirmacion")
     * 
     */

    public function confirmar(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine): Response
    {
       
        return $this->render('alojamiento/confirmacion.html.twig');
    }


}
