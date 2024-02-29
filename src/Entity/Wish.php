<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Wishes')]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: 'id', type: Types::INTEGER, nullable: false, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(name: 'title', type: Types::STRING, length: 250, nullable: false)]
    private ?string $title = null;

    #[ORM\Column(name: 'description', type: Types::TEXT, length: 2000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'author', type: Types::STRING, length: 50, nullable: false)]
    private ?string $author = null;

    #[ORM\Column(name: 'is_published', type: Types::BOOLEAN, nullable: false)]
    private bool $isPublished = true;

    #[ORM\Column(name: 'date_created', type: Types::DATETIME_MUTABLE, nullable: false)]
    private DateTime $dateCreated;

    /**
     * @param string|null $title
     * @param string|null $description
     * @param string|null $author
     * @param bool $isPublished
     */
    public function __construct(?string $title, ?string $description, ?string $author, bool $isPublished)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->isPublished = $isPublished;
        $this->dateCreated = new DateTime('now');
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }
}