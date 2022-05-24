<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use App\Form\CreateFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('nombre'),
            TextField::new('caracteristicas'),
            TextField::new('descripcion'),
            TextField::new('precio'),
            
          
        ];
    }
    
}
