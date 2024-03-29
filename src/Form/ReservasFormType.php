<?php

namespace App\Form;


use App\Entity\PedidoReserva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;




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
        ->add('huespedes',NumberType::class) ;
    
       
    }      

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PedidoReserva::class 
        ]);
    }
}