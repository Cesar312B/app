<?php

namespace App\Entity;

use App\Repository\AsistenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AsistenciaRepository::class)
 */
class Asistencia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true,scale=2)
     * @Assert\Range(
     *      max = 2,
     *      maxMessage = "Valor maximo permitido por registro {{ limit }}"
     * )
     */
    private $Asistencia;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="asistencias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity=Periodo::class, inversedBy="asistencias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $periodo;


    /**
     * @ORM\ManyToOne(targetEntity=Paralelo::class, inversedBy="asistencia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paralelo;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsistencia(): ?int
    {
        return $this->Asistencia;
    }

    public function setAsistencia(?int $Asistencia): self
    {
        $this->Asistencia = $Asistencia;

        return $this;
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

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getPeriodo(): ?Periodo
    {
        return $this->periodo;
    }

    public function setPeriodo(?Periodo $periodo): self
    {
        $this->periodo = $periodo;

        return $this;
    }

    public function getParalelo(): ?Paralelo
    {
        return $this->paralelo;
    }

    public function setParalelo(?Paralelo $paralelo): self
    {
        $this->paralelo = $paralelo;

        return $this;
    }
}
