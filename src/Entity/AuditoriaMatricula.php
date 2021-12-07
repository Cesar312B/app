<?php

namespace App\Entity;

use App\Repository\AuditoriaMatriculaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuditoriaMatriculaRepository::class)
 */
class AuditoriaMatricula
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Employed::class, inversedBy="auditoriaMatriculas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employed;



    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    
    public function __construct()
     {
   
    $this->fecha= new \DateTime();
  
     }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accion;

   

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


    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getAccion(): ?string
    {
        return $this->accion;
    }

    public function setAccion(string $accion): self
    {
        $this->accion = $accion;

        return $this;
    }

 
}
