<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\ReservaRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Reserva;


class SessionCesta {

/**
     * The request stack.
     *
     * @var RequestStack
     */
    private $requestStack;

    /**
     * The cart repository.
     *
     * @var ReservaRepository
     */
    private $ReservaRepository;

    /**
     * @var string
     */
    const CART_KEY_NAME = 'cart_id';
    

    public function __construct(RequestStack $requestStack,ReservaRepository $ReservaRepository)
    {
       
        $this->requestStack = $requestStack;
        $this->ReservaRepository = $ReservaRepository;      
    }
    

/**
     * Gets the cart in session.
     *
     * @return Reserva|null
     */
    public function getCart(): ?Reserva
    {
        return $this->ReservaRepository->findOneBy([
            'id' => $this->getCartId(),
            'status' => Reserva::STATUS_CART
        ]);
    }
    /**
     * Sets the cart in session.
     *
     * @param Reserva $cart
     */
    public function setCart(Reserva $cart): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $cart->getId());
    }

    /**
     * Returns the cart id.
     *
     * @return int|null
     */
    private function getCartId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
   

}