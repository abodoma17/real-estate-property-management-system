<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Enums\PropertyStatusEnum;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\Table(
    name: "properties"
)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(
        length: 255,
        nullable: false
    )]
    #[Assert\NotNull(message: "Title is required")]
    #[Assert\NotBlank(message: "Title can not be blank")]
    private string $title;

    #[ORM\Column(
        type: Types::TEXT,
        nullable: false
    )]
    #[Assert\NotNull(message: "Description is required")]
    #[Assert\NotBlank(message: "Description can not be blank")]
    private string $description;

    #[ORM\Column(
        type: Types::DECIMAL,
        precision: 10,
        scale: 0,
        options: [
            "unsigned" => true
        ]
    )]
    #[Assert\GreaterThan(0, message: "Price must be greater than 0")]
    private string $price;

    #[ORM\Column(
        length: 255,
        nullable: false
    )]
    #[Assert\NotNull(message: "Location is required")]
    #[Assert\NotBlank(message: "Location can not be blank")]
    private string $location;

    #[ORM\Column(
        length: 100,
        nullable: false
    )]
    private string $status;

    #[ORM\Column(
        type: Types::DATETIME_IMMUTABLE,
        nullable: false
    )]
    private \DateTimeImmutable $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
