<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\User;
use App\Entity\Regiones;
use App\Entity\Reserva;
use App\Entity\Persona;
use App\Entity\ResetPasswordRequest;
use App\Entity\Images;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(HotelCrudController::class)->generateUrl());

       

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProyectoOrbi');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Regiones', 'fas fa-list', Regiones::class);
        yield MenuItem::linkToCrud('Reservas', 'fas fa-list', Reserva::class);
        yield MenuItem::section('Alojamientos');
        yield MenuItem::linkToCrud('Alojamientos', 'fas fa-list', Hotel::class);
        yield MenuItem::linkToCrud('Imagenes', 'fas fa-list', Images::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('info Usuarios', 'fas fa-list', Persona::class);
        yield MenuItem::linkToCrud('Contraseñas Recuperadas', 'fas fa-list', ResetPasswordRequest::class);
        
    }
}
