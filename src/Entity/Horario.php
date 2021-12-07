<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorarioRepository::class)
 */
class Horario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Dia;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Hora_inicio;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Hora_salida;

    /**
     * @ORM\ManyToOne(targetEntity=Paralelo::class, inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paralelo;

  


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDia(): ?string
    {
        return $this->Dia;
    }

    public function setDia(string $Dia): self
    {
        $this->Dia = $Dia;

        return $this;
    }

    public function getHoraInicio(): ?string
    {
        return $this->Hora_inicio;
    }

    public function setHoraInicio(string $Hora_inicio): self
    {
        $this->Hora_inicio = $Hora_inicio;

        return $this;
    }

    public function getHoraSalida(): ?string
    {
        return $this->Hora_salida;
    }

    public function setHoraSalida(string $Hora_salida): self
    {
        $this->Hora_salida = $Hora_salida;

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
