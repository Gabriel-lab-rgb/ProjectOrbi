<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    
    public function configureFields(string $pageName): iterable
    {

        $avatar = ImageField::new('images')->setBasePath('img/usuarios')->setLabel('Photo');
        $avatarTextFile = TextField::new('images');

        return [
            //IdField::new('id'),
            EmailField::new('email'),
            BooleanField::new('is_verified'),
            ArrayField::new('roles'),
            ImageField::new('images')->setUploadDir('/public/img/usuarios')->setLabel('Photo')
            
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('roles')
            
            
        ;
    }
    
}
