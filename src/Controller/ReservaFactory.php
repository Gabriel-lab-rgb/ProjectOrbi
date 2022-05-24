<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\Hotel;
use App\Entity\PedidoReserva;

/**
 * Class CartManager
 * @package App\Manager
 */
class ReservaFactory
{
     /**
     * Creates an order.
     *
     * @return Reserva
     */
    public function create(): Reserva
    {
        $reserva = new Reserva();
        
        $reserva
            ->setStatus(Reserva::STATUS_CART)
            ->setCreateAt(new \DateTime())
            ->setUpdateAt(new \DateTime());
            
            
        return $reserva;
    }

    /**
     * Creates an item for a product.
     *
     * @param Alojamiento $product
     *
     * @return OrderItem
     */
    public function createItem(Alojamiento $Alojamiento,$llegada,$salida,$adultos,$ninos): OrderItem
    {
        $item = new PedidoReserva();
        $item->setAlojamiento($Alojamiento);
        $item->setLlegada($llegada);
        $item->setLlegada($salida);
        $item->setLlegada($adultos);
        $item->setLlegada($ninos);

        return $item;
    }
}
