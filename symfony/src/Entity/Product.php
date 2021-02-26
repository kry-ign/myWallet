<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $ProductName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CategoryID;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;


    /**
     * @ORM\Column(type="integer")
     */
    private $UserID;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="ProductID")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getCategryID(): ?string
    {
        return $this->CategoryID;
    }

    public function setCategryID(string $CategryID): self
    {
        $this->CategoryID = $CategryID;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCategoryID(): ?Category
    {
        return $this->CategoryID;
    }

    public function setCategoryID(?Category $CategoryID): self
    {
        $this->CategoryID = $CategoryID;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->UserID;
    }

    public function setUserID(int $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addProductID($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeProductID($this);
        }

        return $this;
    }
}
