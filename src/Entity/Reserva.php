<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $total =0;

    /**
     * @ORM\Column(type="date")
     */
    private $createAt;

   
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_CART;
    const STATUS_CART='pendiente';
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity=PedidoReserva::class, cascade={"persist","remove"}, mappedBy="pedido", orphanRemoval=true)
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

   

   
    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getTotal(): float
    {
        
        $total=0;
       foreach($this->getItems() as $item){

              $total+=$item->getTotal();
              $this->total=$total;
            }
    return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    

    public function getUsuario(): ?user
    {
        return $this->usuario;
    }

    public function setUsuario(?user $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return Collection<int, pedidoReserva>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(pedidoReserva $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setPedido($this);
        }

        return $this;
    }

    public function removeItem(pedidoReserva $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getPedido() === $this) {
                $item->setPedido(null);
            }
        }

        return $this;
    }

   
    public function removeItems():self{


        foreach($this->getItems() as $item){
            $this->removeItem($item);
        }
        return $this;
    }

    
    
  
}
