<?php

namespace App\Form\EventListener;

use App\Entity\Reserva;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CartManager;

class SaveCartListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    /**
     * Removes all items from the cart when the clear button is clicked.
     *
     * @param FormEvent $event
     */
    public function postSubmit(FormEvent $event):void
    {
        $form = $event->getForm();
        $cart = $form->getData();

        if (!$cart instanceof Reserva) {
            return;
        }

        // Is the clear button clicked?
        if (!$form->get('save')->isClicked()) {
            return;
        }

        $cart->setStatus('aceptado');


    }
} 