<?php

namespace App\Entity;

use App\Repository\EmployedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmployedRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields={"Cedula"},
 *     message="Este usuario ya existe"
 * )
 */
class Employed implements UserInterface, PasswordAuthenticatedUserInterface 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


     /**
     * @ORM\Column(type="string", length=10,unique=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 17,
     * )
     */
    private $Cedula;

    /**
     * @ORM\Column(type="string", length=255, )
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Ingreso;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Contrato;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Profesion;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;




    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    
    public function __construct()
    {
      
      
        $this->is_active = true;
        $this->paralelo = new ArrayCollection();
        $this->auditoriaStudents = new ArrayCollection();
        $this->auditoriaMatriculas = new ArrayCollection();
        $this->notas = new ArrayCollection();
      
      
      
    }

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

     /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\OneToMany(targetEntity=Paralelo::class, mappedBy="employed", orphanRemoval=true)
     */
    private $paralelo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=AuditoriaStudent::class, mappedBy="employed", orphanRemoval=true)
     */
    private $auditoriaStudents;

    /**
     * @ORM\OneToMany(targetEntity=AuditoriaMatricula::class, mappedBy="employed", orphanRemoval=true)
     */
    private $auditoriaMatriculas;

    /**
     * @ORM\OneToMany(targetEntity=Notas::class, mappedBy="employed", orphanRemoval=true)
     */
    private $notas;

 


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
       

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }


    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->Fecha_Ingreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $Fecha_Ingreso): self
    {
        $this->Fecha_Ingreso = $Fecha_Ingreso;

        return $this;
    }

    public function getContrato(): ?string
    {
        return $this->Contrato;
    }

    public function setContrato(string $Contrato): self
    {
        $this->Contrato = $Contrato;

        return $this;
    }
    public function getProfesion(): ?string
    {
        return $this->Profesion;
    }

    public function setProfesion(string $Profesion): self
    {
        $this->Profesion = $Profesion;

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
            $paralelo->setEmployed($this);
        }

        return $this;
    }

    public function removeParalelo(Paralelo $paralelo): self
    {
        if ($this->paralelo->removeElement($paralelo)) {
            // set the owning side to null (unless already changed)
            if ($paralelo->getEmployed() === $this) {
                $paralelo->setEmployed(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|AuditoriaStudent[]
     */
    public function getAuditoriaStudents(): Collection
    {
        return $this->auditoriaStudents;
    }

    public function addAuditoriaStudent(AuditoriaStudent $auditoriaStudent): self
    {
        if (!$this->auditoriaStudents->contains($auditoriaStudent)) {
            $this->auditoriaStudents[] = $auditoriaStudent;
            $auditoriaStudent->setEmployed($this);
        }

        return $this;
    }

    public function removeAuditoriaStudent(AuditoriaStudent $auditoriaStudent): self
    {
        if ($this->auditoriaStudents->removeElement($auditoriaStudent)) {
            // set the owning side to null (unless already changed)
            if ($auditoriaStudent->getEmployed() === $this) {
                $auditoriaStudent->setEmployed(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AuditoriaMatricula[]
     */
    public function getAuditoriaMatriculas(): Collection
    {
        return $this->auditoriaMatriculas;
    }

    public function addAuditoriaMatricula(AuditoriaMatricula $auditoriaMatricula): self
    {
        if (!$this->auditoriaMatriculas->contains($auditoriaMatricula)) {
            $this->auditoriaMatriculas[] = $auditoriaMatricula;
            $auditoriaMatricula->setEmployed($this);
        }

        return $this;
    }

    public function removeAuditoriaMatricula(AuditoriaMatricula $auditoriaMatricula): self
    {
        if ($this->auditoriaMatriculas->removeElement($auditoriaMatricula)) {
            // set the owning side to null (unless already changed)
            if ($auditoriaMatricula->getEmployed() === $this) {
                $auditoriaMatricula->setEmployed(null);
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
            $nota->setEmployed($this);
        }

        return $this;
    }

    public function removeNota(Notas $nota): self
    {
        if ($this->notas->removeElement($nota)) {
            // set the owning side to null (unless already changed)
            if ($nota->getEmployed() === $this) {
                $nota->setEmployed(null);
            }
        }

        return $this;
    }

}
