<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Common\Util;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 * @ORM\Table(name="evento")
 */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $titulo;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /** @ORM\Column(type="text") */
    protected $descripcion;

    /** @ORM\Column(type="date") */
    protected $fecha;

    /** @ORM\Column(type="time") */
    protected $hora;

    /** @ORM\Column(type="integer") */
    protected $duracion;

    /** @ORM\Column(type="string") */
    protected $idioma;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disertante", inversedBy="eventos")
     * @ORM\JoinColumn(name="disertante_id", referencedColumnName="id")
     */
    protected $disertante;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuario", inversedBy="eventos")
     * @ORM\JoinTable(name="evento_usuario",
     *      joinColumns={@ORM\JoinColumn(name="evento_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
     * )
     */
    protected $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo($titulo) 
    { 
        $this->titulo = $titulo; 
        $this->setSlug(Util::slugify($this->titulo)); 
        return $this; 
    } 

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;
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

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): self
    {
        $this->hora = $hora;
        return $this;
    }

    public function getHoraFinalizacion()
    {
        return $this->hora->add(new \DateInterval('PT'.$this->duracion.'M'));
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): self
    {
        $this->duracion = $duracion;
        return $this;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): self
    {
        $this->idioma = $idioma;
        return $this;
    }

    public function getDisertante(): ?Disertante
    {
        return $this->disertante;
    }

    public function setDisertante(?Disertante $disertante): self
    {
        $this->disertante = $disertante;
        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        $this->usuarios->removeElement($usuario);
        return $this;
    }
}