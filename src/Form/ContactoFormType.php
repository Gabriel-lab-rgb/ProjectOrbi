<?php

namespace App\Form;


use App\Entity\Contacto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class ContactoFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('asunto')
        ->add('mensaje',TextareaType::class);
   
    }      

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacto::class,
            
        ]);
    }
}