<?php

namespace App\Entity;

use App\Repository\RoomTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomTypeRepository::class)]
#[ORM\Table( name: 'room_type')]
class RoomType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'room_type_code')]
    private ?int $id = null;

    #[ORM\Column(name: 'room_type_name', length: 255)]
    private ?string $TypeName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->TypeName;
    }

    public function setTypeName(string $TypeName): static
    {
        $this->TypeName = $TypeName;

        return $this;
    }
}
