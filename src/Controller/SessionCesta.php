<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\ReservaRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Reserva;



class SessionCesta {

    protected $session;
    protected $alojamientos;
    protected $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
        $this->session = $this->requestStack->getCurrentRequest()->getSession();
        $this->alojamientos = array();

        if ($this->session->has('cesta')) {


            $this->alojamientos = $this->session->get('cesta');
        } else {

            $this->alojamientos = array();
        }
    }

    /*
      public function index(): Response {
      return $this->render('cesta/index.html.twig', [
      'controller_name' => 'CestaController',
      ]);
      }
     */

    public function getAlojamientos() {

        return $this->alojamientos;
    }

    public function carga_articulo($producto, string $salida,string $llegada,int $adultos) {

        $codigo = $producto->getId();
        if (!array_key_exists($codigo, $this->alojamientos)) {

            $this->alojamientos[$codigo]['alojamiento'] =$producto;
            $this->alojamientos[$codigo]['llegada'] =$llegada;
            $this->alojamientos[$codigo]['salida'] =$salida;
            $this->alojamientos[$codigo]['adultos']=$adultos;
    
           }else{

            return;
           }

    }

    public function elimina_unidades($codigo) {

                unset($this->alojamientos[$codigo]);
    }

    public function guardar_cesta() {

        $this->session->set('cesta', $this->alojamientos);
    }
    

    public function get_coste($salida,$llegada) {
        $precio = 0;

        foreach ($this->alojamientos as $producto) {

            $comparacion=$producto['llegada']->diff($producto['salida']);
            $dias=$comparacion->days;      
            $precio += $producto['alojamiento']->getPrecio() * $dias;
        }
        return $precio;
    }


}