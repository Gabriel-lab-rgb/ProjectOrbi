<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use App\Entity\User;

class AdministracionController extends AbstractController
{
    /**
     * @Route("/administracion", name="app_administracion")
     */
    public function index(): Response
    {
        return $this->render('administracion/index.html.twig', [
            'controller_name' => 'AdministracionController',
        ]);
    }
    /**
     * @Route("/administracion/alojamiento", name="alojamientos")
     */

    public function Alojamiento(ManagerRegistry $doctrine): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        return $this->render('administracion/alojamiento/alojamiento.html.twig', array('hoteles'=>$hoteles));
    }

  /**
     * @Route("/administracion/alojamiento/create", name="HotelCreate")
     */

    public function CreateAlojamiento(): Response
    {
        
        return $this->render('administracion/alojamiento/Create.html.twig');
    }

     /**
     * @Route("/administracion/alojamiento/Formcreate", name="FormHotel")
     */

    public function FormCreateAlojamiento(ManagerRegistry $doctrine,Request $request): Response
    {

        $entityManager=$this->getDoctrine()->getManager();

      
        $nombre=$_POST['nombre'];
        $telefono=$_POST['telefono'];
        $actividad=$_POST['actividad'];
        $precio=$_POST['precio'];
        $caracteristicas=$_POST['caracteristicas'];
        $descripcion=$_POST['descripcion'];
        $direccion=$_POST['direccion'];
        $comunidad=$_POST['comunidad'];
        $provincia=$_POST['provincia'];
        $latitud=$_POST['latitud'];
        $longitud=$_POST['longitud'];



        $ubicacion=new Ubicaciones();

        $ubicacion->setDireccion($direccion);
        $ubicacion->setComunidad($comunidad);
        $ubicacion->setProvincia($provincia);
        $ubicacion->setLatitud($latitud);
        $ubicacion->setLongitud($longitud); 
        $hotel=new Hotel();
        $hotel->setNombre($nombre);
        $hotel->setTelefono($telefono);
        $hotel->setActividad($actividad);
        $hotel->setCaracteristicas($caracteristicas);
        $hotel->setDescripcion($descripcion);
        $hotel->setPrecio($precio);
        $hotel->setUbicacion($ubicacion);
        
       

        $entityManager->persist($ubicacion);   
        $entityManager->persist($hotel);

        $entityManager->flush();
 
        return $this->RedirectToRoute('alojamientos');
        
       
    }


     /**
     * @Route("/administracion/alojamiento/details/{id}", name="HotelDetails")
     */

    public function DAlojamiento(ManagerRegistry $doctrine,int $id): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        return $this->render('administracion/alojamiento/Details.html.twig', ['hotel'=>$hotel]);
    }

      /**
     * @Route("/administracion/alojamiento/edit/{id}", name="HotelEdit")
     */

    public function EditAlojamiento(ManagerRegistry $doctrine,int $id): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        return $this->render('administracion/alojamiento/Edit.html.twig', ['hotel'=>$hotel]);
    }

      /**
     * @Route("/administracion/alojamiento/editH/{id}", name="EditH")
     */

    public function EditH(ManagerRegistry $doctrine,int $id): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
       $hotel=$doctrine->getRepository(Hotel::class)->find($id);
       $nombre=$_POST['nombre'];
       $telefono=$_POST['telefono'];
       $actividad=$_POST['actividad'];
       $caracteristicas=$_POST['caracteristicas'];
       $descripcion=$_POST['descripcion'];
       $direccion=$_POST['direccion'];
       $comunidad=$_POST['comunidad'];
       $provincia=$_POST['provincia'];
       $latitud=$_POST['latitud'];
       $longitud=$_POST['longitud'];

       $hotel->setNombre($nombre);
       $hotel->setTelefono($telefono);
       $hotel->setActividad($actividad);
       $hotel->setCaracteristicas($caracteristicas);
       $hotel->setDescripcion($descripcion);
       $ubicacion=$doctrine->getRepository(Ubicaciones::class)->find($hotel->getUbicacion()->getId());
       $ubicacion->setDireccion($direccion);
       $ubicacion->setComunidad($comunidad);
       $ubicacion->setProvincia($provincia);
       $ubicacion->setLatitud($latitud);
       $ubicacion->setLongitud($longitud);


       
       
       $entityManager->persist($hotel);
       $entityManager->persist($ubicacion);
       $entityManager->flush();

       return $this->RedirectToRoute('alojamientos');
       
    }

      /**
     * @Route("/administracion/alojamiento/delete/{id}", name="HotelDelete")
     */

    public function DeleteAlojamiento(ManagerRegistry $doctrine,int $id): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        return $this->render('administracion/alojamiento/Delete.html.twig', ['hotel'=>$hotel]);
    }

/** 
*
*
*
**/

 /**
     * @Route("/administracion/usuarios", name="usuarios")
     */

    public function Usuarios(ManagerRegistry $doctrine): Response
    {
        $usuarios=$doctrine->getRepository(User::class)->findAll();
        return $this->render('administracion/usuarios/usuarios.html.twig', array('usuarios'=>$usuarios));
    }


  /**
     * @Route("/administracion/usuario/create", name="UsuarioCreate")
     */

    public function CreateUsuario(): Response
    {
        
        return $this->render('administracion/usuarios/Create.html.twig');
    }

     /**
     * @Route("/administracion/usuario/edit/{id}", name="UsuarioEdit")
     */

    public function EditUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        return $this->render('administracion/usuarios/Edit.html.twig', ['usuario'=>$usuario]);
    }


     /**
     * @Route("/administracion/usuario/details/{id}", name="UsuarioDetails")
     */

    public function DetailsUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        return $this->render('administracion/usuarios/Details.html.twig', ['usuario'=>$usuario]);
    }


     /**
     * @Route("/administracion/usuario/delete/{id}", name="UsuarioDelete")
     */

    public function DeleteUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        return $this->render('administracion/usuarios/Delete.html.twig', ['hotel'=>$hotel]);
    }

    
}




