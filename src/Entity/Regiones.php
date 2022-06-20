<?php

namespace App\Entity;

use App\Repository\RegionesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RegionesRepository::class)
 */
class Regiones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"hotel", "list_hotel"})
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $nombre;

    /**
     * @ORM\Column(type="decimal",precision=11, scale=8, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $longitud;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=8, nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $latitud;

    /**
     * @ORM\Column(type="text",nullable=true)
     * @Groups({"hotel", "list_hotel"})
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Ubicaciones::class, mappedBy="region", orphanRemoval=true)
     */
    private $ubicaciones;

   

    public function __construct()
    {
        $this->ubicaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(?string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(?string $latitud): self
    {
        $this->latitud = $latitud;

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

    /**
     * @return Collection<int, Ubicaciones>
     */
    public function getUbicaciones(): Collection
    {
        return $this->ubicaciones;
    }

    public function addUbicacione(Ubicaciones $ubicacione): self
    {
        if (!$this->ubicaciones->contains($ubicacione)) {
            $this->ubicaciones[] = $ubicacione;
            $ubicacione->setRegion($this);
        }

        return $this;
    }

    public function removeUbicacione(Ubicaciones $ubicacione): self
    {
        if ($this->ubicaciones->removeElement($ubicacione)) {
            // set the owning side to null (unless already changed)
            if ($ubicacione->getRegion() === $this) {
                $ubicacione->setRegion(null);
            }
        }

        return $this;
    }


    public function __toString(){

        return $this->nombre;
    }

    
}
