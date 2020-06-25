<?php

namespace App\Entity;

use App\Repository\RechercheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RechercheRepository::class)
 */
class Recherche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Recherche_data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRechercheData(): ?string
    {
        return $this->Recherche_data;
    }

    public function setRechercheData(string $Recherche_data): self
    {
        $this->Recherche_data = $Recherche_data;

        return $this;
    }
}
