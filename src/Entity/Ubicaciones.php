<?php

namespace App\Entity;

use App\Repository\UbicacionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UbicacionesRepository::class)
 */
class Ubicaciones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"hotel", "list_hotel"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"hotel", "list_hotel"})
     * 
     */
    private $provincia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     * 
     */
    private $comunidad;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=8)
     * @Groups({"hotel", "list_hotel"})
     * 
     */
    private $latitud;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=8)
     * @Groups({"hotel", "list_hotel"})
     * 
     */
    private $longitud;

    /**
     * @ORM\OneToOne(targetEntity=Hotel::class, mappedBy="ubicacion", cascade={"persist", "remove"})
     *
     */
    private $hotel;

    
    public function __construct()
    {
        $this->hotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getComunidad(): ?string
    {
        return $this->comunidad;
    }

    public function setComunidad(?string $comunidad): self
    {
        $this->comunidad = $comunidad;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(Hotel $hotel): self
    {
        // set the owning side of the relation if necessary
        if ($hotel->getUbicacion() !== $this) {
            $hotel->setUbicacion($this);
        }

        $this->hotel = $hotel;

        return $this;
    }

    
}
