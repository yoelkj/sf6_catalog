<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\DBAL\Types\Types;

use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Locale]
    private $locale;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 140)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    private $body;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bgImage;

    #[ORM\Column(type: 'string', length: 255)]
    private $body_image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bodyVideo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orderRow;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCore = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    /**
     * @var \DateTime
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created', type: Types::DATE_MUTABLE)]
    private $created;

    /**
     * @var \DateTime
     */
    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable]
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

    public function getBgImage(): ?string
    {
        return $this->bgImage;
    }

    public function setBgImage(?string $bgImage): self
    {
        $this->bgImage = $bgImage;

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

    public function getBodyImage(): ?string
    {
        return $this->body_image;
    }

    public function setBodyImage(string $body_image): self
    {
        $this->body_image = $body_image;

        return $this;
    }

    public function getBodyVideo(): ?string
    {
        return $this->bodyVideo;
    }

    public function setBodyVideo(?string $bodyVideo): self
    {
        $this->bodyVideo = $bodyVideo;

        return $this;
    }

    public function getOrderRow(): ?int
    {
        return $this->orderRow;
    }

    public function setOrderRow(?int $orderRow): self
    {
        $this->orderRow = $orderRow;

        return $this;
    }

    public function isIsCore(): ?bool
    {
        return $this->isCore;
    }

    public function setIsCore(?bool $isCore): self
    {
        $this->isCore = $isCore;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
