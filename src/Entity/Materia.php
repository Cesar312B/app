<?php

namespace App\Entity;

use App\Repository\MateriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=MateriaRepository::class)
 */
class Materia
{
    /**
     * @ORM\Id|
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Materia;



    /**
     * @ORM\Column(type="float",scale=2)
     */
    private $Duracion;

   
    /**
     * @ORM\ManyToOne(targetEntity=Carrera::class, inversedBy="materias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Carrera;




   

    /**
     * @ORM\ManyToOne(targetEntity=Nivel::class, inversedBy="materias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nivel;

    /**
     * @ORM\OneToMany(targetEntity=Paralelo::class, mappedBy="materia", orphanRemoval=true)
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

    public function getMateria(): ?string
    {
        return $this->Materia;
    }

    public function setMateria(string $Materia): self
    {
        $this->Materia = $Materia;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->Duracion;
    }

    public function setDuracion(int $Duracion): self
    {
        $this->Duracion = $Duracion;

        return $this;
    }


    public function getCarrera(): ?Carrera
    {
        return $this->Carrera;
    }

    public function setCarrera(?Carrera $Carrera): self
    {
        $this->Carrera = $Carrera;

        return $this;
    }

   

    public function getNivel(): ?Nivel
    {
        return $this->nivel;
    }

    public function setNivel(?Nivel $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * @return Collection|Paralelo[]
     */
    public function getParalelos(): Collection
    {
        return $this->paralelo;
    }

    public function addParalelo(Paralelo $paralelo): self
    {
        if (!$this->paralelo->contains($paralelo)) {
            $this->paralelo[] = $paralelo;
            $paralelo->setMateria($this);
        }

        return $this;
    }

    public function removeParalelo(Paralelo $paralelo): self
    {
        if ($this->paralelo->removeElement($paralelo)) {
            // set the owning side to null (unless already changed)
            if ($paralelo->getMateria() === $this) {
                $paralelo->setMateria(null);
            }
        }

        return $this;
    }

  
}
