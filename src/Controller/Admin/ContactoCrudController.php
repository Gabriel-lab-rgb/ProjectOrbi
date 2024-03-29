<?php

namespace App\Controller\Admin;

use App\Entity\Contacto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ContactoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contacto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            TextField::new('asunto'),
            TextEditorField::new('mensaje'),
        ];
    }
    
}
