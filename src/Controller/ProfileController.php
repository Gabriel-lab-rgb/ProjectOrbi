<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\ProfileFormType;
use App\Controller\CartManager;
use App\Form\SecurityFormType;
use App\Entity\User;
use App\Entity\Persona;
use App\Form\ReservaType;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $persona=$doctrine->getRepository(Persona::class)->findOneBy(array('user'=> $this->getUser()));
        $form = $this->createForm(ProfileFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $p=$form['Persona'];
            $persona->setNombre($p->get('nombre')->getData());
            $persona->setApellidos($p->get('apellidos')->getData());
            $persona->setCodigoPostal($p->get('CodigoPostal')->getData());
            $persona->setTelefono($p->get('telefono')->getData());
            $persona->setFechaNacimiento($p->get('FechaNacimiento')->getData());


            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($persona);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }


        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),'persona'=> $persona
        ]);
    }

    /**
     * @Route("/security", name="security")
     */

    public function security(Request $request,ManagerRegistry $doctrine,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $usuario=$this->getUser();
       
        $form = $this->createForm(SecurityFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
       
            $image=$form->get('images')->getData();

            $newFilename = md5(uniqid()).'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('images_usuarios'),
                $newFilename);

           $usuario->setImages($newFilename);
              
        $usuario->setPassword(
            $userPasswordHasher->hashPassword(
                    $usuario,
                    $form->get('plainPassword')->getData()
                )
            );
        $usuario->setUsername($form->get('username')->getData());
        $usuario->setEmail($form->get('email')->getData());

        $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');

        }


        return $this->render('profile/security.html.twig', [
            'form' => $form->createView(),'usuario'=>$usuario
        ]);
    }



     /**
     * @Route("/reservas", name="reservas")
     */

    public function reservas(Request $request,ManagerRegistry $doctrine,CartManager $cartManager): Response
    {
      
       


 
            $cart = $cartManager->getCurrentCart();
            $form = $this->createForm(ReservaType::class, $cart);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $cart->setUpdateAt(new \DateTime());
                $cartManager->save($cart);
                return $this->redirectToRoute('reservas');
                
            
        }
    
        return $this->render('profile/reservas.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
           /*'cesta'=> $cesta->getAlojamientos()*/
        
        ]);


    }

    /**
     * @Route("/eliminar", name="eliminar")
     */

    public function eliminar(Request $request,ManagerRegistry $doctrine,UserPasswordHasherInterface $userPasswordHasher ,SessionCesta $cesta): Response
    {
      

        

        return $this->render('profile/reservas.html.twig', [
            /*'cart' => $cart,*/
           /* 'form' => $form->createView()*/
           'cesta'=> $cesta->getAlojamientos()
        
        ]);


    }




}
