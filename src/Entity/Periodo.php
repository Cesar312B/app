<?php

namespace App\Entity;

use App\Repository\PeriodoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PeriodoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields={"Periodo","Fecha"},
 *     message="Este Periodo ya existe"
 * )
 */
class Periodo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true, unique=true)
     */
    private $Fecha;

    /**
     * @ORM\OneToMany(targetEntity=Notas::class, mappedBy="periodo", orphanRemoval=true)
     */
    private $notas;

    /**
     * @ORM\OneToMany(targetEntity=Asistencia::class, mappedBy="periodo", orphanRemoval=true)
     */
    private $asistencias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $Periodo;

  

   

    public function __construct()
    {
        $this->notas = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
        $this->avanceProgramaticos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(?\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * @return Collection|Notas[]
     */
    public function getNotas(): Collection
    {
        return $this->notas;
    }

    public function addNota(Notas $nota): self
    {
        if (!$this->notas->contains($nota)) {
            $this->notas[] = $nota;
            $nota->setPeriodo($this);
        }

        return $this;
    }

    public function removeNota(Notas $nota): self
    {
        if ($this->notas->removeElement($nota)) {
            // set the owning side to null (unless already changed)
            if ($nota->getPeriodo() === $this) {
                $nota->setPeriodo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Asistencia[]
     */
    public function getAsistencias(): Collection
    {
        return $this->asistencias;
    }

    public function addAsistencia(Asistencia $asistencia): self
    {
        if (!$this->asistencias->contains($asistencia)) {
            $this->asistencias[] = $asistencia;
            $asistencia->setPeriodo($this);
        }

        return $this;
    }

    public function removeAsistencia(Asistencia $asistencia): self
    {
        if ($this->asistencias->removeElement($asistencia)) {
            // set the owning side to null (unless already changed)
            if ($asistencia->getPeriodo() === $this) {
                $asistencia->setPeriodo(null);
            }
        }

        return $this;
    }

    public function getPeriodo(): ?string
    {
        return $this->Periodo;
    }

    public function setPeriodo(?string $Periodo): self
    {
        $this->Periodo = $Periodo;

        return $this;
    }


 
}
