<?php

namespace App\Entity;

use App\Repository\NivelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NivelRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields="Nivel",
 *     message="Este Nivel ya existe"
 * )
 */
class Nivel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $Nivel;

    /**
     * @ORM\OneToMany(targetEntity=Materia::class, mappedBy="nivel", orphanRemoval=true)
     */
    private $materias;

    public function __construct()
    {
        $this->materias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNivel(): ?string
    {
        return $this->Nivel;
    }

    public function setNivel(string $Nivel): self
    {
        $this->Nivel = $Nivel;

        return $this;
    }

    /**
     * @return Collection|Materia[]
     */
    public function getMaterias(): Collection
    {
        return $this->materias;
    }

    public function addMateria(Materia $materia): self
    {
        if (!$this->materias->contains($materia)) {
            $this->materias[] = $materia;
            $materia->setNivel($this);
        }

        return $this;
    }

    public function removeMateria(Materia $materia): self
    {
        if ($this->materias->removeElement($materia)) {
            // set the owning side to null (unless already changed)
            if ($materia->getNivel() === $this) {
                $materia->setNivel(null);
            }
        }

        return $this;
    }
}
