<?php

namespace App\Entity;

use App\Repository\ParaleloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParaleloRepository::class)
 */
class Paralelo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity=Employed::class, inversedBy="paralelo")
     * @ORM\JoinColumn(nullable=true)
     */
    private $employed;

    /**
     * @ORM\ManyToOne(targetEntity=Materia::class, inversedBy="paralelo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materia;

    /**
     * @ORM\ManyToOne(targetEntity=Grupo::class, inversedBy="paralelo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grupo;

 
    /**
     * @ORM\OneToMany(targetEntity=Horario::class, mappedBy="paralelo", orphanRemoval=true)
     */
    private $horarios;

    /**
     * @ORM\OneToMany(targetEntity=Asistencia::class, mappedBy="paralelo", orphanRemoval=true)
     */
    private $asistencia;

    /**
     * @ORM\OneToMany(targetEntity=Notas::class, mappedBy="paralelo", orphanRemoval=true)
     */
    private $notas;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $estado;


  

    public function __construct()
    {
        $this->is_active = true;
        $this->horarios = new ArrayCollection();
        $this->asistencia = new ArrayCollection();
        $this->notas = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getEmployed(): ?Employed
    {
        return $this->employed;
    }

    public function setEmployed(?Employed $employed): self
    {
        $this->employed = $employed;

        return $this;
    }

    public function getMateria(): ?Materia
    {
        return $this->materia;
    }

    public function setMateria(?Materia $materia): self
    {
        $this->materia = $materia;

        return $this;
    }

    public function getGrupo(): ?Grupo
    {
        return $this->grupo;
    }

    public function setGrupo(?Grupo $grupo): self
    {
        $this->grupo = $grupo;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }



  





    /**
     * @return Collection|Horario[]
     */
    public function getHorarios(): Collection
    {
        return $this->horarios;
    }

    public function addHorario(Horario $horario): self
    {
        if (!$this->horarios->contains($horario)) {
            $this->horarios[] = $horario;
            $horario->setParalelo($this);
        }

        return $this;
    }

    public function removeHorario(Horario $horario): self
    {
        if ($this->horarios->removeElement($horario)) {
            // set the owning side to null (unless already changed)
            if ($horario->getParalelo() === $this) {
                $horario->setParalelo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Asistencia[]
     */
    public function getAsistencia(): Collection
    {
        return $this->asistencia;
    }

    public function addAsistencium(Asistencia $asistencium): self
    {
        if (!$this->asistencia->contains($asistencium)) {
            $this->asistencia[] = $asistencium;
            $asistencium->setParalelo($this);
        }

        return $this;
    }

    public function removeAsistencium(Asistencia $asistencium): self
    {
        if ($this->asistencia->removeElement($asistencium)) {
            // set the owning side to null (unless already changed)
            if ($asistencium->getParalelo() === $this) {
                $asistencium->setParalelo(null);
            }
        }

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
            $nota->setParalelo($this);
        }

        return $this;
    }

    public function removeNota(Notas $nota): self
    {
        if ($this->notas->removeElement($nota)) {
            // set the owning side to null (unless already changed)
            if ($nota->getParalelo() === $this) {
                $nota->setParalelo(null);
            }
        }

        return $this;
    }

   

   

    
}
