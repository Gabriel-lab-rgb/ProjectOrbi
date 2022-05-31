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
use App\Entity\User;
use App\Entity\Persona;
use App\Form\ReservaType;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\Model\ChangePassword;
use App\Form\Type\ChangePasswordType;


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
            $persona->setDni($p->get('dni')->getData());
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
        

        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);
        $persona=$doctrine->getRepository(Persona::class)->findOneBy(array('user'=> $this->getUser()));
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
    
            $session = $request->getSession();

            if ($form->isValid()) {

                

                $em = $this->getDoctrine()->getManager();
                $user = $this->getUser(); 
                
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                            $user,
                            $form->get('password')->getData()
                    )
                );
                $em->persist($user);
                $flush = $em->flush();
                if ($flush === null) {
                    $session->getFlashBag()->add('success', 'Cambio de contraseña realizado con exito');
                    return $this->redirectToRoute("security"); //redirigimos la pagina si se incluido correctamete
                } else {
                    $session->getFlashBag()->add('warning', 'Error al cambiar la contraseña');
                }
            } else {
               // dump($form->getErrors());
                $session->getFlashBag()->add('warning', 'El password no se ha editado por un error en el formulario !');
            }
        }
        
       


        return $this->render('profile/security.html.twig', [
            'persona'=>$persona,'form'=>$form->createView()
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
