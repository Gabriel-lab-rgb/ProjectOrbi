<?php

namespace App\Controller\Admin;

use App\Entity\Contacto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contacto::class;
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
