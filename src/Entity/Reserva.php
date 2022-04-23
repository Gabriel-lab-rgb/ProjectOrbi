<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $llegada;

    /**
     * @ORM\Column(type="date")
     */
    private $salida;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $total;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer")
     */
    private $adultos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ninos;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $bebes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mascotas;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

   

   
    public function getId(): ?int
    {
        return $this->id;
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

    public function setSalida(\DateTimeInterface $salida): self
    {
        $this->salida = $salida;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
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

    public function getBebes(): ?int
    {
        return $this->bebes;
    }

    public function setBebes(int $bebes): self
    {
        $this->bebes = $bebes;

        return $this;
    }

    public function getMascotas(): ?bool
    {
        return $this->mascotas;
    }

    public function setMascotas(?bool $mascotas): self
    {
        $this->mascotas = $mascotas;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

   

  
}
