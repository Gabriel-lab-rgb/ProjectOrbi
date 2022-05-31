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
use Symfony\Component\Form\Extension\Core\Type\FileType;




class ImagesType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('images',FileType::class,[
            'label'=>false,
           // 'multiple' =>true,
            'mapped'=>false,
            'required' =>false,
            /*'constraints' =>[new File([
                'maxSize' => '1024K',
                'mimeTypes'=>[
                    'image/jpeg','image/png'
                ],
                ]) 
                ]*/
        ])
      ;/*
      $builder->get('images')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    // transform the array to a string
                    return implode(', ', $tagsAsArray);
                }
            ));
*/
    }

  
}