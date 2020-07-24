<?php

namespace App\Entity;

use App\Repository\PlacePhotosRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=PlacePhotosRepository::class)
 * @ORM\Table(name="places_photos")
 */
class PlacePhoto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     * @Serializer\AccessType("public_method")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent()
    {
        if (\is_resource($this->content)) {
            return stream_get_contents($this->content);
        }

        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }
}
