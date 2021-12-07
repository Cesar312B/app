<?php

namespace App\Entity;

use App\Repository\NotasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NotasRepository::class)
 */
class Notas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    
  /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota1;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota2;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota3;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota4;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota5;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota6;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota7;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota8;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota9;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota10;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota11;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota12;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota13;

    /**
     * @ORM\Column(type="float", nullable=true ,scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota14;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota15;

    /**
     * @ORM\Column(type="float", nullable=true, scale=2)
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "Valor maximo permitido {{ limit }}"
     * )
     */
    private $nota_supletorio;

  

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="notas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

  
    /**
     * @ORM\ManyToOne(targetEntity=Periodo::class, inversedBy="notas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $periodo;

    /**
     * @ORM\ManyToOne(targetEntity=Paralelo::class, inversedBy="notas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paralelo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Estado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jornada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_matricula;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota1_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota2_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota3_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota4_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota5_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota6_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota7_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota8_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota9_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota10_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota11_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota12_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota13_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota14_descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nota15_descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Employed::class, inversedBy="notas")
     * @ORM\JoinColumn(nullable=true)
     */
    private $employed;

 





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNota1(): ?float
    {
        return $this->nota1;
    }

    public function setNota1(?float $nota1): self
    {
        $this->nota1 = $nota1;

        return $this;
    }

    public function getNota2(): ?float
    {
        return $this->nota2;
    }

    public function setNota2(?float $nota2): self
    {
        $this->nota2 = $nota2;

        return $this;
    }

    public function getNota3(): ?float
    {
        return $this->nota3;
    }

    public function setNota3(?float $nota3): self
    {
        $this->nota3 = $nota3;

        return $this;
    }

    public function getNota4(): ?float
    {
        return $this->nota4;
    }

    public function setNota4(?float $nota4): self
    {
        $this->nota4 = $nota4;

        return $this;
    }

    public function getNota5(): ?float
    {
        return $this->nota5;
    }

    public function setNota5(?float $nota5): self
    {
        $this->nota5 = $nota5;

        return $this;
    }

    public function getNota6(): ?float
    {
        return $this->nota6;
    }

    public function setNota6(?float $nota6): self
    {
        $this->nota6 = $nota6;

        return $this;
    }

    public function getNota7(): ?float
    {
        return $this->nota7;
    }

    public function setNota7(?float $nota7): self
    {
        $this->nota7 = $nota7;

        return $this;
    }

    public function getNota8(): ?float
    {
        return $this->nota8;
    }

    public function setNota8(?float $nota8): self
    {
        $this->nota8 = $nota8;

        return $this;
    }

    public function getNota9(): ?float
    {
        return $this->nota9;
    }

    public function setNota9(?float $nota9): self
    {
        $this->nota9 = $nota9;

        return $this;
    }

    public function getNota10(): ?float
    {
        return $this->nota10;
    }

    public function setNota10(?float $nota10): self
    {
        $this->nota10 = $nota10;

        return $this;
    }

    public function getNota11(): ?float
    {
        return $this->nota11;
    }

    public function setNota11(?float $nota11): self
    {
        $this->nota11 = $nota11;

        return $this;
    }

    public function getNota12(): ?float
    {
        return $this->nota12;
    }

    public function setNota12(?float $nota12): self
    {
        $this->nota12 = $nota12;

        return $this;
    }

    public function getNota13(): ?float
    {
        return $this->nota13;
    }

    public function setNota13(?float $nota13): self
    {
        $this->nota13 = $nota13;

        return $this;
    }

    public function getNota14(): ?float
    {
        return $this->nota14;
    }

    public function setNota14(?float $nota14): self
    {
        $this->nota14 = $nota14;

        return $this;
    }

    public function getNota15(): ?float
    {
        return $this->nota15;
    }

    public function setNota15(?float $nota15): self
    {
        $this->nota15 = $nota15;

        return $this;
    }

    public function getNotaSupletorio(): ?float
    {
        return $this->nota_supletorio;
    }

    public function setNotaSupletorio(?float $nota_supletorio): self
    {
        $this->nota_supletorio = $nota_supletorio;

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

    public function getEstado(): ?string
    {
        return $this->Estado;
    }

    public function setEstado(string $Estado): self
    {
        $this->Estado = $Estado;

        return $this;
    }

    public function getJornada(): ?string
    {
        return $this->jornada;
    }

    public function setJornada(?string $jornada): self
    {
        $this->jornada = $jornada;

        return $this;
    }

    public function getTipoMatricula(): ?string
    {
        return $this->tipo_matricula;
    }

    public function setTipoMatricula(?string $tipo_matricula): self
    {
        $this->tipo_matricula = $tipo_matricula;

        return $this;
    }

    public function getNota1Descripcion(): ?string
    {
        return $this->nota1_descripcion;
    }

    public function setNota1Descripcion(?string $nota1_descripcion): self
    {
        $this->nota1_descripcion = $nota1_descripcion;

        return $this;
    }

    public function getNota2Descripcion(): ?string
    {
        return $this->nota2_descripcion;
    }

    public function setNota2Descripcion(?string $nota2_descripcion): self
    {
        $this->nota2_descripcion = $nota2_descripcion;

        return $this;
    }

    public function getNota3Descripcion(): ?string
    {
        return $this->nota3_descripcion;
    }

    public function setNota3Descripcion(?string $nota3_descripcion): self
    {
        $this->nota3_descripcion = $nota3_descripcion;

        return $this;
    }

    public function getNota4Descripcion(): ?string
    {
        return $this->nota4_descripcion;
    }

    public function setNota4Descripcion(?string $nota4_descripcion): self
    {
        $this->nota4_descripcion = $nota4_descripcion;

        return $this;
    }

    public function getNota5Descripcion(): ?string
    {
        return $this->nota5_descripcion;
    }

    public function setNota5Descripcion(?string $nota5_descripcion): self
    {
        $this->nota5_descripcion = $nota5_descripcion;

        return $this;
    }

    public function getNota6Descripcion(): ?string
    {
        return $this->nota6_descripcion;
    }

    public function setNota6Descripcion(?string $nota6_descripcion): self
    {
        $this->nota6_descripcion = $nota6_descripcion;

        return $this;
    }

    public function getNota7Descripcion(): ?string
    {
        return $this->nota7_descripcion;
    }

    public function setNota7Descripcion(?string $nota7_descripcion): self
    {
        $this->nota7_descripcion = $nota7_descripcion;

        return $this;
    }

    public function getNota8Descripcion(): ?string
    {
        return $this->nota8_descripcion;
    }

    public function setNota8Descripcion(?string $nota8_descripcion): self
    {
        $this->nota8_descripcion = $nota8_descripcion;

        return $this;
    }

    public function getNota9Descripcion(): ?string
    {
        return $this->nota9_descripcion;
    }

    public function setNota9Descripcion(?string $nota9_descripcion): self
    {
        $this->nota9_descripcion = $nota9_descripcion;

        return $this;
    }

    public function getNota10Descripcion(): ?string
    {
        return $this->nota10_descripcion;
    }

    public function setNota10Descripcion(?string $nota10_descripcion): self
    {
        $this->nota10_descripcion = $nota10_descripcion;

        return $this;
    }

    public function getNota11Descripcion(): ?string
    {
        return $this->nota11_descripcion;
    }

    public function setNota11Descripcion(?string $nota11_descripcion): self
    {
        $this->nota11_descripcion = $nota11_descripcion;

        return $this;
    }

    public function getNota12Descripcion(): ?string
    {
        return $this->nota12_descripcion;
    }

    public function setNota12Descripcion(?string $nota12_descripcion): self
    {
        $this->nota12_descripcion = $nota12_descripcion;

        return $this;
    }

    public function getNota13Descripcion(): ?string
    {
        return $this->nota13_descripcion;
    }

    public function setNota13Descripcion(?string $nota13_descripcion): self
    {
        $this->nota13_descripcion = $nota13_descripcion;

        return $this;
    }

    public function getNota14Descripcion(): ?string
    {
        return $this->nota14_descripcion;
    }

    public function setNota14Descripcion(?string $nota14_descripcion): self
    {
        $this->nota14_descripcion = $nota14_descripcion;

        return $this;
    }

    public function getNota15Descripcion(): ?string
    {
        return $this->nota15_descripcion;
    }

    public function setNota15Descripcion(?string $nota15_descripcion): self
    {
        $this->nota15_descripcion = $nota15_descripcion;

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


  
}
