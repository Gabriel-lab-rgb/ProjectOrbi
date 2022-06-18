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
use App\Entity\Persona;
use App\Entity\PedidoReserva;
use App\Entity\Regiones;
use App\Entity\Ubicaciones;
use App\Controller\SesionCesta;
use Symfony\Component\Serializer\SerializerInterface;



class AlojamientoController extends AbstractController
{
    /**
     * @Route("/alojamiento/{nombre}", name="alojamiento" ,methods={"GET","HEAD"})
     * 
     */
    public function index(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine,string $nombre,SerializerInterface $serializer): Response
    {
       
         $hotel=$doctrine->getRepository(Hotel::class)->findOneBy(array('Nombre'=> $nombre));
         $alojamientos=[];
         $region=$doctrine->getRepository(Regiones::class)->findOneBy(array('nombre' => $hotel->getUbicacion()->getRegion()->getNombre()));
       
        $ubicaciones=$doctrine->getRepository(Ubicaciones::class)->findBy(array('region' => $region));

        foreach($ubicaciones as $ubicacion){

            $alojamiento=$doctrine->getRepository(Hotel::class)->find($ubicacion);
         
            array_push($alojamientos,$alojamiento);
        }
        shuffle($alojamientos);
         
         $form = $this->createForm(ReservasFormType::class);
         
  

        return $this->render('alojamiento/index.html.twig', [
            'alojamiento' => $hotel, 'alojamientos' => $alojamientos, 'form' => $form->createView()
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
        $salida=new \DateTime($ite['salida']);
        $llegada=new \DateTime($ite['llegada']);
        $comparacion=$salida->diff($llegada);
        $dias=$comparacion->days;
        $total= $precio*$dias;
        $form = $this->createForm(ReservasFormType::class);
        $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){

        
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        $item=$form->getData();
        $item->setAlojamiento($hotel);
       
       /* $fecha = new \DateTime();
        $usuario=$this->getUser();
        $reserva->setUser($usuario);
        $reserva->setFecha($fecha);
        $reserva->setHotel($hotel);
        $reserva->setTotal($total);
     
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($reserva);   
        $entityManager->flush();*/

    /*
        $Fsalida=$form->get('salida')->getData();
        $Fllegada=$form->get('llegada')->getData();
        $salida = $Fsalida->format('Y-m-d');
        $llegada = $Fllegada->format('Y-m-d');

        $adultos=$form->get('adultos')->getData();
        $ninos=$form->get('ninos')->getData();

        $cesta->carga_articulo($hotel,$salida,$llegada,$adultos);
        $cesta->guardar_cesta();
*/
        $cart = $cartManager->getCurrentCart();
        $cart
            ->addItem($item)
            ->setUpdateAt(new \DateTime())
            ->setUsuario($this->getUser());
        $cartManager->save($cart);

         return $this->redirectToRoute('confirmacion');
       }
 

        return $this->render('alojamiento/stays.html.twig',['precio'=>$precio,'dias'=>$dias,'total'=> $total ,  'alojamiento' =>$hotel,'form' => $form->createView(),'formGet' => $ite]);
    }

     /**
     * @Route("/confirmacion", name="confirmacion")
     * 
     */

    public function confirmar(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine): Response
    {

        $persona=$doctrine->getRepository(Persona::class)->findOneBy(['user' =>$this->getUser()]);
        $nombre=$persona->getNombre();
       
        return $this->render('alojamiento/confirmacion.html.twig',['nombre'=>$nombre]);
    }


}
