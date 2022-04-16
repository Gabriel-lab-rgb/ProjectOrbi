<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"hotel", "list_hotel"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"hotel", "list_hotel"})
     */
    private $Nombre;


    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $Telefono;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $Actividad;

    /**
     * @ORM\OneToOne(targetEntity=Ubicaciones::class, inversedBy="hotel", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hotel", "list_hotel"})
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caracteristicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $precio;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }


    public function getTelefono(): ?string
    {
        return $this->Telefono;
    }

    public function setTelefono(?string $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getActividad(): ?string
    {
        return $this->Actividad;
    }

    public function setActividad(?string $Actividad): self
    {
        $this->Actividad = $Actividad;

        return $this;
    }

    public function getUbicacion(): ?Ubicaciones
    {
        return $this->ubicacion;
    }

    public function setUbicacion(Ubicaciones $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getCaracteristicas(): ?string
    {
        return $this->caracteristicas;
    }

    public function setCaracteristicas(?string $caracteristicas): self
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

   
}
