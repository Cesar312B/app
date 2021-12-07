<?php

namespace App\Entity;

use App\Repository\AuditoriaStudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuditoriaStudentRepository::class)
 */
class AuditoriaStudent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accion;

    /**
     * @ORM\ManyToOne(targetEntity=Employed::class, inversedBy="auditoriaStudents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Cedula;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;


public function __construct()
{
   
    $this->fecha= new \DateTime();
  
}


  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccion(): ?string
    {
        return $this->accion;
    }

    public function setAccion(?string $accion): self
    {
        $this->accion = $accion;

        return $this;
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

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(string $Apellido): self
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->Cedula;
    }

    public function setCedula(string $Cedula): self
    {
        $this->Cedula = $Cedula;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

}
