<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Hotel;
use App\Entity\Ubicaciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Form\Type\UbicacionesType;
use App\Form\Type\AlojamientoType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class CreateFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('Alojamiento',AlojamientoType::class)
        ->add('Ubicaciones',UbicacionesType::class);
        
         
    }


}