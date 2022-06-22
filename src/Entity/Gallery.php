<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 140)]
    private $name;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive = false;

    #[ORM\OneToMany(mappedBy: 'Gallery', targetEntity: GalleryImages::class)]
    private $galleryImages;

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

    public function __construct()
    {
        $this->galleryImages = new ArrayCollection();
    }

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

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, GalleryImages>
     */
    public function getGalleryImages(): Collection
    {
        return $this->galleryImages;
    }

    public function addGalleryImage(GalleryImages $galleryImage): self
    {
        if (!$this->galleryImages->contains($galleryImage)) {
            $this->galleryImages[] = $galleryImage;
            $galleryImage->setGallery($this);
        }

        return $this;
    }

    public function removeGalleryImage(GalleryImages $galleryImage): self
    {
        if ($this->galleryImages->removeElement($galleryImage)) {
            // set the owning side to null (unless already changed)
            if ($galleryImage->getGallery() === $this) {
                $galleryImage->setGallery(null);
            }
        }

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
