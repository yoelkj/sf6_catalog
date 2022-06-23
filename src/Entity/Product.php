<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'string', length: 140)]
    private $code;

    #[ORM\Column(type: 'text', nullable: true)]
    private $body;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    private $weightGrammage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantityPerBox;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $storageLifeMonths;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private $category;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
    private $brand;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isNew = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isBestSeller = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRecommended = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\Column(name: 'created', type: Types::DATE_MUTABLE)]
    private $created;

    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getWeightGrammage(): ?string
    {
        return $this->weightGrammage;
    }

    public function setWeightGrammage(?string $weightGrammage): self
    {
        $this->weightGrammage = $weightGrammage;

        return $this;
    }

    public function getQuantityPerBox(): ?int
    {
        return $this->quantityPerBox;
    }

    public function setQuantityPerBox(?int $quantityPerBox): self
    {
        $this->quantityPerBox = $quantityPerBox;

        return $this;
    }

    public function getStorageLifeMonths(): ?int
    {
        return $this->storageLifeMonths;
    }

    public function setStorageLifeMonths(?int $storageLifeMonths): self
    {
        $this->storageLifeMonths = $storageLifeMonths;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function isIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(?bool $isNew): self
    {
        $this->isNew = $isNew;

        return $this;
    }

    public function isIsBestSeller(): ?bool
    {
        return $this->isBestSeller;
    }

    public function setIsBestSeller(?bool $isBestSeller): self
    {
        $this->isBestSeller = $isBestSeller;

        return $this;
    }

    public function isIsRecommended(): ?bool
    {
        return $this->isRecommended;
    }

    public function setIsRecommended(?bool $isRecommended): self
    {
        $this->isRecommended = $isRecommended;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
    
}
