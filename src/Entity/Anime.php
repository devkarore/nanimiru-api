<?php

namespace App\Entity;

use App\Repository\AnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Attribute\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post()
    ],
    normalizationContext: ['groups' => ['anime:read']],
    denormalizationContext: ['groups' => ['anime:write']]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'title' => 'partial',
    'year' => 'exact',
    'genres' => 'exact',
    'moods' => 'exact',
    'platforms' => 'exact',
])]

#[ORM\Entity(repositoryClass: AnimeRepository::class)]
class Anime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['anime:read'])]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(length: 255)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?string $synopsis = null;

    #[Assert\Positive]
    #[ORM\Column(nullable: true)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?int $year = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?string $thumbnailUrl = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column(nullable: true)]
    #[Groups(['anime:read', 'anime:write'])]
    private ?int $ageRating = null;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'animes')]
    #[Groups(['anime:read', 'anime:write'])]
    private Collection $genres;

    /**
     * @var Collection<int, Mood>
     */
    #[ORM\ManyToMany(targetEntity: Mood::class, inversedBy: 'animes')]
    #[Groups(['anime:read', 'anime:write'])]
    private Collection $moods;

    /**
     * @var Collection<int, Platform>
     */
    #[ORM\ManyToMany(targetEntity: Platform::class, inversedBy: 'animes')]
    #[Groups(['anime:read', 'anime:write'])]
    private Collection $platforms;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->moods = new ArrayCollection();
        $this->platforms = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $thumbnailUrl): static
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    public function getAgeRating(): ?int
    {
        return $this->ageRating;
    }

    public function setAgeRating(?int $ageRating): static
    {
        $this->ageRating = $ageRating;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addAnime($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);{
            $genre->removeAnime($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Mood>
     */
    public function getMoods(): Collection
    {
        return $this->moods;
    }

    public function addMood(Mood $mood): static
    {
        if (!$this->moods->contains($mood)) {
            $this->moods->add($mood);
            $mood->addAnime($this);
        }

        return $this;
    }

    public function removeMood(Mood $mood): static
    {
        $this->moods->removeElement($mood);{
        $mood->removeAnime($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Platform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(Platform $platform): static
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
            $platform->addAnime($this);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): static
    {
        $this->platforms->removeElement($platform);{
        $platform->removeAnime($this);
    }
        return $this;
    }


}
