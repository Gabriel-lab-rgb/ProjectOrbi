<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use App\Form\CreateFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use App\Form\Type\ImagesType;
//use App\Form\ImagesFormType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        //$imageFile = ImageField::new('images')->setFormType(ImagesType::class);
       // $image = ImageField::new('images')->setBasePath('public/img/alojamientos');
        
        $fields= [
           
            TextField::new('nombre'),
            AssociationField::new('actividad'),
            TextField::new('caracteristicas'),
            TextField::new('descripcion'),
            TextField::new('telefono'),
            IntegerField::new('precio'),
            AssociationField::new('ubicacion'),
            //CollectionField::new('images')
           
           // ->setEntryType(ImagesFormType::class),
            //->setUploadDir('/public/img/alojamientos'),

          //  AssociationField::new('actividad'),
          //  IntegerField::new('precio'),
           
            //CollectionField::new('ubicacion')
            
          
        ];


       // if($pageName==Crud::PAGE_INDEX){
       // $fields[]=$image;

       // }else{

        //    $fields[]=$imageFile;
        //}

        return $fields;
    }
    
}
