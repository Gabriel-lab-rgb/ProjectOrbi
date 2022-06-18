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
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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

       {
            //IdField::new('id'),
            yield  EmailField::new('email');
            yield  BooleanField::new('is_verified');
            yield  ArrayField::new('roles');
          
        if (Crud::PAGE_INDEX === $pageName){
            yield ImageField::new('images')
            ->setBasePath('img/usuarios')
            ->setLabel('Photo');
        } elseif (Crud::PAGE_EDIT === $pageName){
            yield  ImageField::new('images')->setUploadDir('/public/img/usuarios')->setLabel('Photo');
        }
    };

}
public function configureFilters(Filters $filters): Filters
{
    return $filters
        ->add('roles')
        ->add('isVerified');
        
}

/*
public function updateEntity($entity)
    {
        $this->hashPassWord($entity);
        parent::updateEntity($entity);
    }

public function persistEntity($entity)
    {
        $this->hashPassWord($entity);
        parent::persistEntity($entity);
    }

public function hashPassWord(BeforeEntityPersistedEvent $event)
{
    $entity = $event->getEntityInstance();

// comprobamos si se trata de una entidad User para continuar
    if (!($entity instanceof User)) {
        return;
    }

    $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $entity->getPlainPassword()));
}*/

}
