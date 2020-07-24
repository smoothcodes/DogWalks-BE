<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 * @ORM\Table(
 *     name="places",
 *     schema="dog_walks",
 *     indexes={@Index(name="coords_search_idx", columns={"longitude", "latitude"})}
 * )
 * @JMS\ExclusionPolicy("all")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @JMS\Expose()
     * @JMS\Groups({"all", "single"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Groups({"single"})
     * @JMS\Expose()
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @JMS\Groups({"single"})
     * @JMS\Expose()
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=17)
     * @JMS\Groups({"all", "single"})
     * @JMS\Expose()
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=20, scale=17)
     * @JMS\Groups({"all", "single"})
     * @JMS\Expose()
     *
     */
    private $latitude;

    /**
     * @ORM\OneToMany(targetEntity=PlacePhoto::class, mappedBy="place", orphanRemoval=true, cascade={"persist"})
     * @JMS\Groups({"single"})
     * @JMS\AccessType("public_method")
     */
    private $photos;

    /**
     * @ORM\ManyToMany(targetEntity=PlaceType::class, cascade={"persist"})
     * @ORM\JoinTable(name="dog_walks.place_place_type")
     * @JMS\Expose()
     * @JMS\Groups({"single"})
     */
    private $placeTypes;

    public function __construct()
    {
        $this->id = str_replace(['+', '/'], ['-','_'], substr(base64_encode(md5(uniqid(), true)), 0, 6));
        $this->photos = new ArrayCollection();
        $this->placeTypes = new ArrayCollection();
    }

    public function getId(): ?string
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection|PlacePhoto[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(PlacePhoto $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setPlace($this);
        }

        return $this;
    }

    public function removePhoto(PlacePhoto $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getPlace() === $this) {
                $photo->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlaceType[]
     */
    public function getPlaceTypes(): Collection
    {
        return $this->placeTypes;
    }

    public function addPlaceType(PlaceType $placeType): self
    {
        if (!$this->placeTypes->contains($placeType)) {
            $this->placeTypes[] = $placeType;
        }

        return $this;
    }

    public function removePlaceType(PlaceType $placeType): self
    {
        if ($this->placeTypes->contains($placeType)) {
            $this->placeTypes->removeElement($placeType);
        }

        return $this;
    }
}
