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
    public function __construct(SessionCesta $cesta, EntityManagerInterface $entityManager) {
        $this->SessionCesta = $cesta;
        $this->entityManager = $entityManager;
    }


    public function addCart(): void {

        $producto = $doctrine->getRepository(Productos::class)->find($id);
        $unidades = $_POST['unidades'];
        $cesta->carga_articulo($producto);
        $cesta->guardar_cesta();
        
    }
}