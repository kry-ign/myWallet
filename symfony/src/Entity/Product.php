<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Product
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $productId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $productCategory;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private float $productValue;

    /**
     * @var string
     * @ORM\Column(type="datetime")
     */
    private string $dateAdded;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductCategory(): string
    {
        return $this->productCategory;
    }

    /**
     * @param string $productCategory
     */
    public function setProductCategory(string $productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @return float
     */
    public function getProductValue(): float
    {
        return $this->productValue;
    }

    /**
     * @param float $productValue
     */
    public function setProductValue(float $productValue): void
    {
        $this->productValue = $productValue;
    }

    /**
     * @return string
     */
    public function getDateAdded(): string
    {
        return $this->dateAdded;
    }

    /**
     * @param string $dateAdded
     */
    public function setDateAdded(string $dateAdded): void
    {
        $this->dateAdded = $dateAdded;
    }


}