<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use App\Form\Type\PersonaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ProfileFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('Persona',PersonaType::class);  
    }

}
