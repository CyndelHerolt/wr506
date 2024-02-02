<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model;
use App\Controller\CreateMediaObjectAction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['media_object:read']],
    types: ['https://schema.org/MediaObject'],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            controller: CreateMediaObjectAction::class,
            deserialize: false,
            validationContext: ['groups' => ['Default', 'media_object_create']],
            openapi: new Model\Operation(
                requestBody: new Model\RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary'
                                    ]
                                ]
                            ]
                        ]
                    ])
                )
            )
        )
    ]
)]
class MediaObject
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['media_object:read'])]
    public ?string $contentUrl = null;

    #[Vich\UploadableField(mapping: "media_object", fileNameProperty: "filePath")]
    #[Assert\NotNull(groups: ['media_object_create'])]
    public ?File $file = null;

    #[ORM\Column(nullable: true)]
    public ?string $filePath = null;

    #[ORM\OneToMany(mappedBy: 'mediaObject', targetEntity: Movie::class)]
    private Collection $movie;

    #[ORM\OneToMany(mappedBy: 'mediaObject', targetEntity: Category::class)]
    private Collection $category;

    #[ORM\OneToMany(mappedBy: 'mediaObject', targetEntity: Actor::class)]
    private Collection $actor;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->actor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(?string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movie->contains($movie)) {
            $this->movie->add($movie);
            $movie->setMediaObject($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        if ($this->movie->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getMediaObject() === $this) {
                $movie->setMediaObject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setMediaObject($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getMediaObject() === $this) {
                $category->setMediaObject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actor->contains($actor)) {
            $this->actor->add($actor);
            $actor->setMediaObject($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actor->removeElement($actor)) {
            // set the owning side to null (unless already changed)
            if ($actor->getMediaObject() === $this) {
                $actor->setMediaObject(null);
            }
        }

        return $this;
    }

}