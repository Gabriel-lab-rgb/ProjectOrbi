<?php

namespace App\Controller\Admin;

use App\Entity\Persona;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PersonaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Persona::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            AssociationField::new('user'),
            TextField::new('nombre'),
            TextField::new('apellidos'),
            TextField::new('dni'),
            DateField::new('fecha_nacimiento'),
            
        ];
    }
   
}
