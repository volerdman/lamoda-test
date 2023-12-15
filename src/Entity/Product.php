<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $code;

    /**
     * @ORM\Column(type="integer")
     */
    private int $count;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $reserved;

    /**
     * @ORM\Column(type="integer")
     */
    private int $storageId;

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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

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

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getStorageId(): int
    {
        return $this->storageId;
    }

    public function setStorageId(Storage $storageId): self
    {
        $this->storageId = $storageId;

        return $this;
    }

    public function isReserved(): bool
    {
        return $this->reserved;
    }

    public function setReserved(bool $reserved): void
    {
        $this->reserved = $reserved;
    }
}
