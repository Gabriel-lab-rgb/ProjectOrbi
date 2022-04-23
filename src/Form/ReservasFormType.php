<?php

namespace App\Form;


use App\Entity\Reserva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;





class ReservasFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('llegada',DateType::class,[
            'widget' => 'single_text',
        ])
        ->add('salida',DateType::class,[
            'widget' => 'single_text',
        ])
        ->add('adultos')
        ->add('ninos')
        ->add('bebes')
        ->add('mascotas');
        

  
       
    }      

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
            
        ]);
    }
}