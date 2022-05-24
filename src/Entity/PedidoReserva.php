<?php

namespace App\Entity;

use App\Repository\PedidoReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoReservaRepository::class)
 */
class PedidoReserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $alojamiento;

    
     /**
     * @ORM\Column(type="date")
     */
    private $llegada;

    /**
     * @ORM\Column(type="date")
     */
    private $salida;

     /**
     * @ORM\Column(type="integer")
     */
    private $adultos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ninos;


    /**
     * @ORM\ManyToOne(targetEntity=Reserva::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pedido;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlojamiento(): ?Hotel
    {
        return $this->alojamiento;
    }

    public function setAlojamiento(?Hotel $alojamiento): self
    {
        $this->alojamiento = $alojamiento;

        return $this;
    }


    public function getLlegada(): ?\DateTimeInterface
    {
        return $this->llegada;
    }

    public function setLlegada(\DateTimeInterface $llegada): self
    {
        $this->llegada = $llegada;

        return $this;
    }

    public function getSalida(): ?\DateTimeInterface
    {
        return $this->salida;
    }

    public function getAdultos(): ?int
    {
        return $this->adultos;
    }

    public function setAdultos(int $adultos): self
    {
        $this->adultos = $adultos;

        return $this;
    }

    public function getNinos(): ?int
    {
        return $this->ninos;
    }

    public function setNinos(?int $ninos): self
    {
        $this->ninos = $ninos;

        return $this;
    }

    public function setSalida(\DateTimeInterface $salida): self
    {
        $this->salida = $salida;

        return $this;
    }

    public function setPedido(?Reserva $pedido): self
    {
        $this->pedido = $pedido;

        return $this;
    }


    public function equals(PedidoReserva $item):bool{

        return $this->getAlojamiento->getId()===$item->getAlojamiento()->getId();
    }

 public function getTotal():float{
    $comparacion=$this->salida()->diff($this->llegada());
    $dias=$comparacion->days;

    return $this->getAlojamiento()->getPrecio()*$dias;
 }

}

