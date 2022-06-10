<?php

namespace App\Controller\Admin;

use App\Entity\Regiones;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
class RegionesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Regiones::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('nombre'),
            TextField::new('latitud'),
            TextField::new('longitud'),
            TextareaField::new('descripcion'),

        ];
    }
    
}
