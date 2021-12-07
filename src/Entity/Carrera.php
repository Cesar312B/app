<?php

namespace App\Entity;

use App\Repository\CarreraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Nzo\UrlEncryptorBundle\Encryptor\Encryptor;

/**
 * @ORM\Entity(repositoryClass=CarreraRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields="Carrera",
 *     message="Esta Carrera ya existe"
 * )
 */
class Carrera
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
    private $Carrera;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Area;

  
    /**
     * @ORM\OneToMany(targetEntity=Materia::class, mappedBy="Carrera", orphanRemoval=true)
     */
    private $materias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_carrera;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modalidad_carrera;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo_carrera;

    public function __construct()
    {
        $this->materias = new ArrayCollection();
    }

    

  

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrera(): ?string
    {
        return $this->Carrera;
    }

    public function setCarrera(string $Carrera): self
    {
        $this->Carrera = $Carrera;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->Area;
    }

    public function setArea(string $Area): self
    {
        $this->Area = $Area;

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
            $materia->setCarrera($this);
        }

        return $this;
    }

    public function removeMateria(Materia $materia): self
    {
        if ($this->materias->removeElement($materia)) {
            // set the owning side to null (unless already changed)
            if ($materia->getCarrera() === $this) {
                $materia->setCarrera(null);
            }
        }

        return $this;
    }

    public function getTipoCarrera(): ?string
    {
        return $this->tipo_carrera;
    }

    public function setTipoCarrera(?string $tipo_carrera): self
    {
        $this->tipo_carrera = $tipo_carrera;

        return $this;
    }

    public function getModalidadCarrera(): ?string
    {
        return $this->modalidad_carrera;
    }

    public function setModalidadCarrera(?string $modalidad_carrera): self
    {
        $this->modalidad_carrera = $modalidad_carrera;

        return $this;
    }

    public function getTituloCarrera(): ?string
    {
        return $this->titulo_carrera;
    }

    public function setTituloCarrera(?string $titulo_carrera): self
    {
        $this->titulo_carrera = $titulo_carrera;

        return $this;
    }

   

}
