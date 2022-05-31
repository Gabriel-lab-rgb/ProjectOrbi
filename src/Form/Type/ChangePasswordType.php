<?php

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use App\Form\Model\ChangePassword;


class ChangePasswordType extends AbstractType{


    
           public function buildForm(FormBuilderInterface $builder, array $options): void
                {

                 $builder
                        ->add('oldPassword', PasswordType::class, array(
                              'label' => 'Ponga su contraseña actual',
                               ))
                        ->add('password', RepeatedType::class, array(
                             "required" => "required",
                             'type' => PasswordType::class,
                             'invalid_message' => 'Los dos campos deben coincidir',
                             'first_options' => array('label' => 'Contraseña nueva', "attr" => array("class" => "form-password form-control")),
                             'second_options' => array('label' => 'Repita la contraseña nueva', "attr" => array("class" => "form-password form-control"))
                    )
            )
    ;
}

public function setDefaultOptions(OptionsResolverInterface $resolver): void
{

    $resolver->setDefaults([
        'data_class' => ChangePassword::class,
        
    ]);
}

public function getName()
{
    return 'change_passwd';
}

}