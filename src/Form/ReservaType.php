<?php

namespace App\Form;

use App\Entity\Reserva;
use App\Form\EventListener\RemoveCartItemListener;
use App\Form\EventListener\ClearCartListener;
use App\Form\EventListener\SaveCartListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $optionszz)
    {
        
        $builder
            ->add('items', CollectionType::class, [
                'entry_type' => ReservasItemType::class
            ])

            ->add('save', SubmitType::class)
            ->add('clear', SubmitType::class);

            
            

        $builder->addEventSubscriber(new RemoveCartItemListener());
        $builder->addEventSubscriber(new ClearCartListener());
        $builder->addEventSubscriber(new SaveCartListener());
    }   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}