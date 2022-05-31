<?php

namespace App\Controller\Admin;

use App\Entity\Ubicaciones;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UbicacionesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ubicaciones::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
          
            TextField::new('direccion'),
            AssociationField::new('region'),
            TextField::new('provincia'),
            TextField::new('comunidad'),
            TextField::new('latitud'),
            TextField::new('longitud'),
        ];
    }
    
}
