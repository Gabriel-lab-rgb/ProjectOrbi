<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use App\Entity\Persona;
use App\Entity\User;
use App\Entity\Regiones;
use App\Entity\Images;
use App\Form\CreateFormType;
use App\Form\Type\PersonaType;
use App\Form\Type\RegionType;
use Symfony\Component\HttpFoundation\File\File;



class AdministracionController extends AbstractController
{
    /**
     * @Route("/admin", name="app_administracion")
     */
    public function index(): Response
    {
        return $this->render('administracion/index.html.twig', [
            'controller_name' => 'AdministracionController',
        ]);
    }
    /**
     * @Route("/admin/alojamientos", name="alojamientos")
     */

    public function Alojamiento(ManagerRegistry $doctrine): Response
    {
        $hoteles=$doctrine->getRepository(Hotel::class)->findAll();
        return $this->render('administracion/alojamiento/alojamiento.html.twig', array('hoteles'=>$hoteles));
    }

  /**
     * @Route("/admin/alojamientos/create", name="AlojamientoCreate")
     */

    public function CreateAlojamiento(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine): Response
    {
        $hotel = new Hotel();
        $ubicacion=new Ubicaciones();
        
        $form = $this->createForm(CreateFormType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $imagenes=$form['Alojamiento']['images'];
            $images=$imagenes->getData();

            foreach($images as $image){

                $newFilename = md5(uniqid()).'.'.$image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $newFilename);

                    $img=new Images();
                    $img->setImageName($newFilename);
                    $hotel->addImage($img);
            }

            $ubi=$form['Ubicaciones'];
            $alo=$form['Alojamiento'];
            

            $ubicacion->setDireccion($ubi->get('direccion')->getData());
            $ubicacion->setComunidad($ubi->get('comunidad')->getData());
            $ubicacion->setProvincia($ubi->get('provincia')->getData());
            $ubicacion->setLatitud($ubi->get('latitud')->getData());
            $ubicacion->setLongitud($ubi->get('longitud')->getData());


            $hotel->setNombre($alo->get('nombre')->getData());
            $hotel->setActividad($alo->get('actividad')->getData());
            $hotel->setCaracteristicas($alo->get('caracteristicas')->getData());
            $hotel->setDescripcion($alo->get('descripcion')->getData());
            $hotel->setPrecio($alo->get('precio')->getData());
            $hotel->setUbicacion($ubicacion);
            
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($ubicacion);   
            $entityManager->persist($hotel);
            
    
            $entityManager->flush();


            return $this->redirectToRoute('alojamientos');
        }
      
 

        
        
        return $this->render('administracion/alojamiento/Create.html.twig',['CreateForm' => $form->createView(),]);
    }

   

     /**
     * @Route("/admin/alojamiento/details/{id}", name="AlojamientoDetails")
     */

    public function DAlojamiento(ManagerRegistry $doctrine,int $id): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        return $this->render('administracion/alojamiento/Details.html.twig', ['hotel'=>$hotel]);
    }

      /**
     * @Route("/admin/alojamiento/edit/{id}", name="AlojamientoEdit")
     */

    public function EditAlojamiento(Request $request,ManagerRegistry $doctrine,int $id): Response
    {
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);

        
        $form = $this->createForm(CreateFormType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $imagenes=$form['Alojamiento']['images'];
            $images=$imagenes->getData();

            foreach($images as $image){

                $newFilename = md5(uniqid()).'.'.$image->guessExtension();

                $image->move(
                    $this->getParameter('images_directory'),
                    $newFilename);

                    $img=new Images();
                    $img->setImageName($newFilename);
                    $hotel->addImage($img);

            }
               
            $ubi=$form['Ubicaciones'];
            $alo=$form['Alojamiento'];
            

            $hotel->setNombre($alo->get('nombre')->getData());
            $hotel->setActividad($alo->get('actividad')->getData());
            $hotel->setCaracteristicas($alo->get('caracteristicas')->getData());
            $hotel->setDescripcion($alo->get('descripcion')->getData());
            $hotel->setPrecio($alo->get('precio')->getData());
            
            $ubicacion=$doctrine->getRepository(Ubicaciones::class)->find($hotel->getUbicacion()->getId());
            $ubicacion->setDireccion($ubi->get('direccion')->getData());
            $ubicacion->setComunidad($ubi->get('comunidad')->getData());
            $ubicacion->setProvincia($ubi->get('provincia')->getData());
            $ubicacion->setLatitud($ubi->get('latitud')->getData());
            $ubicacion->setLongitud($ubi->get('longitud')->getData());



            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($ubicacion);   
            $entityManager->persist($hotel);
            
    
            $entityManager->flush();


            return $this->redirectToRoute('alojamientos');
        }


        
        return $this->render('administracion/alojamiento/Edit.html.twig', ['hotel'=>$hotel,'CreateForm' => $form->createView()]);
    }

     

      /**
     * @Route("/admin/alojamiento/delete/{id}", name="AlojamientoDelete")
     */

    public function DeleteAlojamiento(ManagerRegistry $doctrine,int $id): Response
    {

        
        $hotel=$doctrine->getRepository(Hotel::class)->find($id);
        $ubicacion=$hotel->getUbicacion();

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($ubicacion);
        $entityManager->remove($hotel);

        $entityManager->flush();
        
        return $this->render('administracion/alojamiento/Delete.html.twig', ['hotel'=>$hotel]);
    }



    
/** 
*
*
*
**/

 /**
     * @Route("/admin/regiones", name="region")
     */
    public function regiones(ManagerRegistry $doctrine): Response
    {
        $regiones=$doctrine->getRepository(regiones::class)->findAll();
        return $this->render('administracion/regiones/regiones.html.twig', array('regiones'=>$regiones));
    }


/**
     * @Route("/admin/regiones/create", name="regionCreate")
     */
    public function regionesCreate(ManagerRegistry $doctrine,Request $request): Response
    {
        $region = new Regiones();
        
        $form = $this->createForm(RegionType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
           
            $region->setNombre($form->get('nombre')->getData());
            $region->setLatitud($form->get('latitud')->getData());
            $region->setLongitud($form->get('longitud')->getData());
            $region->setDescripcion($form->get('descripcion')->getData());
            
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($region);   
 
            
    
            $entityManager->flush();

            return $this->redirectToRoute('region');
        }

        return $this->render('administracion/regiones/Create.html.twig', array('CreateForm' => $form->createView()));
    }
    
    /**
     * @Route("/admin/regiones/edit/{id}", name="regionEdit")
     */
    public function regionesEdit(ManagerRegistry $doctrine,Request $request,int $id): Response
    {


        $region=$doctrine->getRepository(Regiones::class)->find($id);

        
        $form = $this->createForm(RegionType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {


            $region->setNombre($form->get('nombre')->getData());
            $region->setLatitud($form->get('latitud')->getData());
            $region->setLongitud($form->get('longitud')->getData());
            $region->setDescripcion($form->get('descripcion')->getData());
            
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($region);   
     

            $entityManager->flush();


            return $this->redirectToRoute('region');
        }
        
        return $this->render('administracion/regiones/Edit.html.twig', ['region'=> $region,'form'=> $form->createView()]);
    }


     /**
     * @Route("/admin/regiones/details/{id}", name="regionDetails")
     */
    public function regionesDetails(ManagerRegistry $doctrine,int $id): Response
    {
        $region=$doctrine->getRepository(Regiones::class)->find($id);
        return $this->render('administracion/regiones/Details.html.twig', array('region'=>$region));
    }


     /**
     * @Route("/admin/regiones/delete/{id}", name="regionDelete")
     */
    public function regionesDelete(ManagerRegistry $doctrine): Response
    {
        $usuarios=$doctrine->getRepository(regiones::class)->findAll();
        return $this->render('administracion/regiones/delete.html.twig', array('usuarios'=>$usuarios));
    }

/** 
*
*
*
**/

 /**
     * @Route("/admin/usuarios", name="usuarios")
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
     * @Route("/admin/usuario/edit/{id}", name="UsuarioEdit")
     */

    public function EditUsuario(Request $request,ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        $persona=$doctrine->getRepository(Persona::class)->findOneBy(array('user'=>$usuario));
        
        $form = $this->createForm(PersonaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $persona->setNombre($form->get('nombre')->getData());
            $persona->setApellidos($form->get('apellidos')->getData());
            $persona->setCodigoPostal($form->get('CodigoPostal')->getData());
            $persona->setTelefono($form->get('telefono')->getData());
            $persona->setFechaNacimiento($form->get('FechaNacimiento')->getData());

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($persona);   
            
            
    
            $entityManager->flush();
            $this->addFlash('notice','datos actualizados');
            return $this->redirectToRoute('usuarios');

        }


        return $this->render('administracion/usuarios/Edit.html.twig', ['form' => $form->createView(),'persona'=>$persona]);
    }


     /**
     * @Route("/admin/usuario/details/{id}", name="UsuarioDetails")
     */

    public function DetailsUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        return $this->render('administracion/usuarios/Details.html.twig', ['usuario'=>$usuario]);
    }

    /**
     * @Route("/admin/usuario/reservas/{id}", name="UsuarioReservas")
     */

    public function ReservasUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        $reservas=$usuario->getReservas();
   
        return $this->render('administracion/usuarios/reservas.html.twig', ['reservas'=>$reservas]);
    }


     /**
     * @Route("/admin/usuario/delete/{id}", name="UsuarioDelete")
     */

    public function DeleteUsuario(ManagerRegistry $doctrine,int $id): Response
    {
        $usuario=$doctrine->getRepository(User::class)->find($id);
        $persona=$doctrine->getRepository(Persona::class)->findOneBy(array('user'=>$usuario));
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($persona);
        $entityManager->remove($usuario);

        $entityManager->flush();
        return $this->render('administracion/usuarios/Delete.html.twig', ['usuario'=>$usuario]);
    }

    
}




