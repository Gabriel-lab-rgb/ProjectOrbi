<?php

namespace App\Form\Type;

use App\Entity\User;
use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class UbicacionesType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('direccion')
        ->add('comunidad')
        ->add('provincia')
        ->add('latitud')
        ->add('longitud');
        
        


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ubicaciones::class,
            
        ]);
    }
}