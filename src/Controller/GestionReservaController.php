<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\CartManager;
use App\Form\ReservaType;
use App\Entity\Reserva;
use App\Entity\PedidoReserva;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class GestionReservaController extends AbstractController
{
    /**
     * @Route("/gestion/reserva", name="app_gestion_reserva")
     */
    public function index(ManagerRegistry $doctrine,Request $request): Response
    {
        $Reservas=$doctrine->getRepository(Reserva::class)->findAll();
       

        /*$form = $this->createForm(ReservaType::class,['reserva' =>$Reservas]);*/


        return $this->render('gestion_reserva/index.html.twig', [
            'reservas' => $Reservas,/*'form'=>$form->createView()*/
        ]);
    }


    /**
     * @Route("/gestion/{id}", name="app_gestion")
     */
    public function details(ManagerRegistry $doctrine,Request $request,int $id): Response
    {
        $pedidos=$doctrine->getRepository(PedidoReserva::class)->findBy(array('pedido'=>$id));

       


        return $this->render('gestion_reserva/details.html.twig', [
            'pedidos' => $pedidos,/*'form'=>$form->createView()*/
        ]);
    }



    /**
     * @Route("/gestion/cancelar/{id}", name="deleteItem")
     */
    public function eliminar(ManagerRegistry $doctrine,Request $request,MailerInterface $mailer,EntityManagerInterface $entityManager,int $id): Response
    {
        $pedido=$doctrine->getRepository(Reserva::class)->find($id);
        $pedido->setStatus('cancelado');
        $entityManager->flush();

        $email=(new Email())
        ->from('grivote615@iesmartinezm.es')
        ->to($pedido->getUsuario()->getEmail())
        ->text(' La Reserva no ha sido aceptada');
        $mailer->send($email);

      

        return $this->redirectToRoute('app_gestion_reserva');

       
    }


    /**
     * @Route("/gestion/aceptar/{id}", name="aceptar")
     */
    public function aceptar(ManagerRegistry $doctrine,Request $request,EntityManagerInterface $entityManager,MailerInterface $mailer,int $id): Response
    {
        $pedido=$doctrine->getRepository(Reserva::class)->find($id);
        $pedido->setStatus('aceptado');

        $entityManager->flush();

        $email=(new Email())
        ->from('grivote615@iesmartinezm.es')
        ->to($pedido->getUsuario()->getEmail())
        ->text('Reserva aceptada');
        $mailer->send($email);

        return $this->redirectToRoute('app_gestion_reserva');

       
    }
}
