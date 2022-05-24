<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Controller\SesionCesta;
use App\Controller\ReservaFactory;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CartManager
 * @package App\Controller
 */
class CartManager
{
    /**
     * @var SessionCesta
     */
    private $SessionCesta;

    /**
     * @var ReservaFactory
     */
    private $cartFactory;


     /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CartManager constructor.
     *
     *  @param SessionCesta $cesta
     * @param ReservaFactory $ReservaFactory
     * 
     */
    public function __construct(SessionCesta $cesta,ReservaFactory $ReservaFactory, EntityManagerInterface $entityManager) {
        $this->SessionCesta = $cesta;
        $this->cartFactory = $ReservaFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Gets the current cart.
     * 
     * @return Reserva
     */
    public function getCurrentCart(): Reserva
    {
        $cart = $this->SessionCesta->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }


    public function save(Reserva $cart): void
    {
        // Persist in database
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        // Persist in session
        $this->SessionCesta->setCart($cart);
    }
}
