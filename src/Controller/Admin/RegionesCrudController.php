<?php

namespace App\Controller\Admin;

use App\Entity\Regiones;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegionesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Regiones::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
