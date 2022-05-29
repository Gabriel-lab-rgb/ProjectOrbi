<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * 
     */
    private $Nombre;


    /**
     * @ORM\OneToOne(targetEntity=Ubicaciones::class, inversedBy="hotel", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hotel", "list_hotel"})
     *  
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"hotel", "list_hotel"})
     */
    private $caracteristicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"hotel", "list_hotel"})
     */
    private $descripcion;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Groups({"hotel", "list_hotel"})
     */
    private $precio;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="alojamiento", orphanRemoval=true, cascade={"persist"})
     * @Groups({"hotel", "list_hotel"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Actividad::class, inversedBy="hotels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $actividad;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $telefono;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    

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

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAlojamiento($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAlojamiento() === $this) {
                $image->setAlojamiento(null);
            }
        }

        return $this;
    }

    public function getActividad(): ?actividad
    {
        return $this->actividad;
    }

    public function setActividad(?actividad $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

   
}
