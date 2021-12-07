<?php

namespace App\Entity;

use App\Repository\GrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GrupoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields="Nombre",
 *     message="Este grupo ya existe"
 * )
 */
class Grupo
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
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity=Paralelo::class, mappedBy="grupo", orphanRemoval=true)
     */
    private $paralelo;

    public function __construct()
    {
        $this->paralelo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection|Paralelo[]
     */
    public function getParalelo(): Collection
    {
        return $this->paralelo;
    }

    public function addParalelo(Paralelo $paralelo): self
    {
        if (!$this->paralelo->contains($paralelo)) {
            $this->paralelo[] = $paralelo;
            $paralelo->setGrupo($this);
        }

        return $this;
    }

    public function removeParalelo(Paralelo $paralelo): self
    {
        if ($this->paralelo->removeElement($paralelo)) {
            // set the owning side to null (unless already changed)
            if ($paralelo->getGrupo() === $this) {
                $paralelo->setGrupo(null);
            }
        }

        return $this;
    }
}
