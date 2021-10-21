<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Loisir::class, mappedBy="activitie", cascade={"persist", "remove"})
     */
    private $loisir;

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

    public function getLoisir(): ?Loisir
    {
        return $this->loisir;
    }

    public function setLoisir(?Loisir $loisir): self
    {
        // unset the owning side of the relation if necessary
        if ($loisir === null && $this->loisir !== null) {
            $this->loisir->setActivitie(null);
        }

        // set the owning side of the relation if necessary
        if ($loisir !== null && $loisir->getActivitie() !== $this) {
            $loisir->setActivitie($this);
        }

        $this->loisir = $loisir;

        return $this;
    }
}
