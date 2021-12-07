<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields={"Cedula"},
 *     message="Este usuario ya existe"
 * )
 */
class Student implements UserInterface, PasswordAuthenticatedUserInterface 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer" ,unique=true)
     */
    private $id;

      /**
     * @ORM\Column(type="string", length=15, unique=true,nullable=true)
     */
    private $Cedula;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\Column(type="string", length=255)
     */
    private $Pais;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $Provincia;


   
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Financiamiento;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Ingreso;

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
        $this->notas = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
        $this->Fecha_Ingreso= new \DateTime();
        $this->solicituds = new ArrayCollection();
        $this->comprobantes = new ArrayCollection();
        $this->auditoriaStudents = new ArrayCollection();
      
      
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
     * @ORM\OneToMany(targetEntity=Notas::class, mappedBy="student", orphanRemoval=true)
     */
    private $notas;

    /**
     * @ORM\OneToMany(targetEntity=Asistencia::class, mappedBy="student", orphanRemoval=true)
     */
    private $asistencias;

  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_identificacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $correo;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $n_convencional;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $codigo_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contacto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parentesco;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $n_contacto;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etnia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idioma_ancestral;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idioma_descripcion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_sangre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categoria_mogratoria;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Pais_ridencia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $provincia_recidencia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discapacidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $n_conadis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $porcentaje_discapacidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_discapacidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_colegio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_bachillerato;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo_superior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titulo_especifico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motivo_ingresos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formacion_padre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formacion_madre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $n_miembrosfamilia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bono_humano;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ingresos_hogar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $repetdo_materia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $perdida_gratuidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $practicas_preprofesionales;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $n_horapracticas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_institucion_practicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sector_ecomomico_practicas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $practica_instituto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alcance_proyecto_vinculacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $estdo_laboral;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sector_economico_laboral;

    /**
     * @ORM\OneToMany(targetEntity=Solicitud::class, mappedBy="student", orphanRemoval=true)
     */
    private $solicituds;

    /**
     * @ORM\OneToMany(targetEntity=Comprobantes::class, mappedBy="student", orphanRemoval=true)
     */
    private $comprobantes;



    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->is_active;
    }


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
        $roles[] = 'ROLE_USER';

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

    public function getPais(): ?string
    {
        return $this->Pais;
    }

    public function setPais(string $Pais): self
    {
        $this->Pais = $Pais;

        return $this;
    }

    
    public function getProvincia(): ?string
    {
        return $this->Provincia;
    }

    public function setProvincia(string $Provincia): self
    {
        $this->Provincia = $Provincia;

        return $this;
    }

  

    public function getTelefono(): ?int
    {
        return $this->Telefono;
    }

    public function setTelefono(int $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getFinanciamiento(): ?string
    {
        return $this->Financiamiento;
    }

    public function setFinanciamiento(string $Financiamiento): self
    {
        $this->Financiamiento = $Financiamiento;

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
            $nota->setStudent($this);
        }

        return $this;
    }

    public function removeNota(Notas $nota): self
    {
        if ($this->notas->removeElement($nota)) {
            // set the owning side to null (unless already changed)
            if ($nota->getStudent() === $this) {
                $nota->setStudent(null);
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
            $asistencia->setStudent($this);
        }

        return $this;
    }

    public function removeAsistencia(Asistencia $asistencia): self
    {
        if ($this->asistencias->removeElement($asistencia)) {
            // set the owning side to null (unless already changed)
            if ($asistencia->getStudent() === $this) {
                $asistencia->setStudent(null);
            }
        }

        return $this;
    }


    public function getTipoIdentificacion(): ?string
    {
        return $this->tipo_identificacion;
    }

    public function setTipoIdentificacion(?string $tipo_identificacion): self
    {
        $this->tipo_identificacion = $tipo_identificacion;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

   

    public function getNConvencional(): ?string
    {
        return $this->n_convencional;
    }

    public function setNConvencional(?string $n_convencional): self
    {
        $this->n_convencional = $n_convencional;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCodigoPostal(): ?string
    {
        return $this->codigo_postal;
    }

    public function setCodigoPostal(string $codigo_postal): self
    {
        $this->codigo_postal = $codigo_postal;

        return $this;
    }

    public function getContacto(): ?string
    {
        return $this->contacto;
    }

    public function setContacto(?string $contacto): self
    {
        $this->contacto = $contacto;

        return $this;
    }

    public function getParentesco(): ?string
    {
        return $this->parentesco;
    }

    public function setParentesco(?string $parentesco): self
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    public function getNContacto(): ?string
    {
        return $this->n_contacto;
    }

    public function setNContacto(?string $n_contacto): self
    {
        $this->n_contacto = $n_contacto;

        return $this;
    }

    public function getEtnia(): ?string
    {
        return $this->etnia;
    }

    public function setEtnia(?string $etnia): self
    {
        $this->etnia = $etnia;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIdiomaAncestral(): ?string
    {
        return $this->idioma_ancestral;
    }

    public function setIdiomaAncestral(?string $idioma_ancestral): self
    {
        $this->idioma_ancestral = $idioma_ancestral;

        return $this;
    }

    public function getIdiomaDescripcion(): ?string
    {
        return $this->idioma_descripcion;
    }

    public function setIdiomaDescripcion(?string $idioma_descripcion): self
    {
        $this->idioma_descripcion = $idioma_descripcion;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getTipoSangre(): ?string
    {
        return $this->tipo_sangre;
    }

    public function setTipoSangre(?string $tipo_sangre): self
    {
        $this->tipo_sangre = $tipo_sangre;

        return $this;
    }

    public function getCategoriaMogratoria(): ?string
    {
        return $this->categoria_mogratoria;
    }

    public function setCategoriaMogratoria(?string $categoria_mogratoria): self
    {
        $this->categoria_mogratoria = $categoria_mogratoria;

        return $this;
    }

    public function getPaisRidencia(): ?string
    {
        return $this->Pais_ridencia;
    }

    public function setPaisRidencia(?string $Pais_ridencia): self
    {
        $this->Pais_ridencia = $Pais_ridencia;

        return $this;
    }

    public function getProvinciaRecidencia(): ?string
    {
        return $this->provincia_recidencia;
    }

    public function setProvinciaRecidencia(?string $provincia_recidencia): self
    {
        $this->provincia_recidencia = $provincia_recidencia;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estado_civil;
    }

    public function setEstadoCivil(?string $estado_civil): self
    {
        $this->estado_civil = $estado_civil;

        return $this;
    }

    public function getDiscapacidad(): ?string
    {
        return $this->discapacidad;
    }

    public function setDiscapacidad(?string $discapacidad): self
    {
        $this->discapacidad = $discapacidad;

        return $this;
    }

    public function getNConadis(): ?string
    {
        return $this->n_conadis;
    }

    public function setNConadis(?string $n_conadis): self
    {
        $this->n_conadis = $n_conadis;

        return $this;
    }

    public function getPorcentajeDiscapacidad(): ?string
    {
        return $this->porcentaje_discapacidad;
    }

    public function setPorcentajeDiscapacidad(?string $porcentaje_discapacidad): self
    {
        $this->porcentaje_discapacidad = $porcentaje_discapacidad;

        return $this;
    }

    public function getTipoDiscapacidad(): ?string
    {
        return $this->tipo_discapacidad;
    }

    public function setTipoDiscapacidad(?string $tipo_discapacidad): self
    {
        $this->tipo_discapacidad = $tipo_discapacidad;

        return $this;
    }

    public function getTipoColegio(): ?string
    {
        return $this->tipo_colegio;
    }

    public function setTipoColegio(?string $tipo_colegio): self
    {
        $this->tipo_colegio = $tipo_colegio;

        return $this;
    }

    public function getTipoBachillerato(): ?string
    {
        return $this->tipo_bachillerato;
    }

    public function setTipoBachillerato(?string $tipo_bachillerato): self
    {
        $this->tipo_bachillerato = $tipo_bachillerato;

        return $this;
    }

    public function getTituloSuperior(): ?string
    {
        return $this->titulo_superior;
    }

    public function setTituloSuperior(?string $titulo_superior): self
    {
        $this->titulo_superior = $titulo_superior;

        return $this;
    }

    public function getTituloEspecifico(): ?string
    {
        return $this->titulo_especifico;
    }

    public function setTituloEspecifico(?string $titulo_especifico): self
    {
        $this->titulo_especifico = $titulo_especifico;

        return $this;
    }

    public function getMotivoIngresos(): ?string
    {
        return $this->motivo_ingresos;
    }

    public function setMotivoIngresos(?string $motivo_ingresos): self
    {
        $this->motivo_ingresos = $motivo_ingresos;

        return $this;
    }

    public function getFormacionPadre(): ?string
    {
        return $this->formacion_padre;
    }

    public function setFormacionPadre(?string $formacion_padre): self
    {
        $this->formacion_padre = $formacion_padre;

        return $this;
    }

    public function getFormacionMadre(): ?string
    {
        return $this->formacion_madre;
    }

    public function setFormacionMadre(?string $formacion_madre): self
    {
        $this->formacion_madre = $formacion_madre;

        return $this;
    }

    public function getNMiembrosfamilia(): ?int
    {
        return $this->n_miembrosfamilia;
    }

    public function setNMiembrosfamilia(?int $n_miembrosfamilia): self
    {
        $this->n_miembrosfamilia = $n_miembrosfamilia;

        return $this;
    }

    public function getBonoHumano(): ?string
    {
        return $this->bono_humano;
    }

    public function setBonoHumano(?string $bono_humano): self
    {
        $this->bono_humano = $bono_humano;

        return $this;
    }

    public function getIngresosHogar(): ?int
    {
        return $this->ingresos_hogar;
    }

    public function setIngresosHogar(?int $ingresos_hogar): self
    {
        $this->ingresos_hogar = $ingresos_hogar;

        return $this;
    }

    public function getRepetdoMateria(): ?string
    {
        return $this->repetdo_materia;
    }

    public function setRepetdoMateria(?string $repetdo_materia): self
    {
        $this->repetdo_materia = $repetdo_materia;

        return $this;
    }

    public function getPerdidaGratuidad(): ?string
    {
        return $this->perdida_gratuidad;
    }

    public function setPerdidaGratuidad(?string $perdida_gratuidad): self
    {
        $this->perdida_gratuidad = $perdida_gratuidad;

        return $this;
    }

    public function getPracticasPreprofesionales(): ?string
    {
        return $this->practicas_preprofesionales;
    }

    public function setPracticasPreprofesionales(?string $practicas_preprofesionales): self
    {
        $this->practicas_preprofesionales = $practicas_preprofesionales;

        return $this;
    }

    public function getNHorapracticas(): ?string
    {
        return $this->n_horapracticas;
    }

    public function setNHorapracticas(?string $n_horapracticas): self
    {
        $this->n_horapracticas = $n_horapracticas;

        return $this;
    }

    public function getTipoInstitucionPracticas(): ?string
    {
        return $this->tipo_institucion_practicas;
    }

    public function setTipoInstitucionPracticas(?string $tipo_institucion_practicas): self
    {
        $this->tipo_institucion_practicas = $tipo_institucion_practicas;

        return $this;
    }

    public function getSectorEcomomicoPracticas(): ?string
    {
        return $this->sector_ecomomico_practicas;
    }

    public function setSectorEcomomicoPracticas(?string $sector_ecomomico_practicas): self
    {
        $this->sector_ecomomico_practicas = $sector_ecomomico_practicas;

        return $this;
    }

    public function getPracticaInstituto(): ?string
    {
        return $this->practica_instituto;
    }

    public function setPracticaInstituto(?string $practica_instituto): self
    {
        $this->practica_instituto = $practica_instituto;

        return $this;
    }

    public function getAlcanceProyectoVinculacion(): ?string
    {
        return $this->alcance_proyecto_vinculacion;
    }

    public function setAlcanceProyectoVinculacion(?string $alcance_proyecto_vinculacion): self
    {
        $this->alcance_proyecto_vinculacion = $alcance_proyecto_vinculacion;

        return $this;
    }

    public function getEstdoLaboral(): ?string
    {
        return $this->estdo_laboral;
    }

    public function setEstdoLaboral(?string $estdo_laboral): self
    {
        $this->estdo_laboral = $estdo_laboral;

        return $this;
    }

    public function getSectorEconomicoLaboral(): ?string
    {
        return $this->sector_economico_laboral;
    }

    public function setSectorEconomicoLaboral(?string $sector_economico_laboral): self
    {
        $this->sector_economico_laboral = $sector_economico_laboral;

        return $this;
    }

    /**
     * @return Collection|Solicitud[]
     */
    public function getSolicituds(): Collection
    {
        return $this->solicituds;
    }

    public function addSolicitud(Solicitud $solicitud): self
    {
        if (!$this->solicituds->contains($solicitud)) {
            $this->solicituds[] = $solicitud;
            $solicitud->setStudent($this);
        }

        return $this;
    }

    public function removeSolicitud(Solicitud $solicitud): self
    {
        if ($this->solicituds->removeElement($solicitud)) {
            // set the owning side to null (unless already changed)
            if ($solicitud->getStudent() === $this) {
                $solicitud->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comprobantes[]
     */
    public function getComprobantes(): Collection
    {
        return $this->comprobantes;
    }

    public function addComprobante(Comprobantes $comprobante): self
    {
        if (!$this->comprobantes->contains($comprobante)) {
            $this->comprobantes[] = $comprobante;
            $comprobante->setStudent($this);
        }

        return $this;
    }

    public function removeComprobante(Comprobantes $comprobante): self
    {
        if ($this->comprobantes->removeElement($comprobante)) {
            // set the owning side to null (unless already changed)
            if ($comprobante->getStudent() === $this) {
                $comprobante->setStudent(null);
            }
        }

        return $this;
    }

  

   
  
}
