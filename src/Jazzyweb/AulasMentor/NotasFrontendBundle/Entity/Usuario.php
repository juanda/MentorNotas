<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\UsuarioRepository")
 *
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class Usuario implements AdvancedUserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     *
     * @Assert\Length(max="255")
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     *
     * @Assert\Length(max="255")
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Regex(
     *  pattern="/^[\w-]+$/",
     *  message="El nombre de usuario no puede contener más que caracteres alfanuméricos y guiones")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Regex(
     *  pattern="/^[\w-]+$/",
     *  message="El password no puede contener más que caracteres alfanuméricos y guiones")
     */
    private $password;

    /**
     * @var string $password_again
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Regex(
     *     pattern="/^[\w-]+$/",
     *     message="El password no puede contener más que caracteres alfanuméricos y guiones")
     */
    private $password_again;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Email(
     *     message = "La dirección '{{ value }}' no es válida.")
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     *
     * @Assert\Type(type="bool", message="El valor {{ value }} debe ser {{ type }}.")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="tokenRegistro", type="string", length=255)
     */
    private $tokenRegistro;

    ////ASOCIACIONES////

    /**
     * @ORM\OneToMany(targetEntity="Nota", mappedBy="usuario")
     */
    private $notas;

    /**
     * @ORM\OneToMany(targetEntity="Contrato", mappedBy="usuario")
     */
    private $contratos;

    /**
     * @ORM\OneToMany(targetEntity="Etiqueta", mappedBy="usuario")
     */
    private $etiquetas;

    /**
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="usuarios")
     */
    private $grupos;

    ////FIN ASOCIACIONES////

    public function __construct()
    {
        $this->notas = new ArrayCollection();
        $this->contratos = new ArrayCollection();
        $this->etiquetas = new ArrayCollection();
        $this->grupos = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password_again
     *
     * @param string $password_again
     */
    public function setPasswordAgain($password) {
        $this->password_again = $password;
    }

    /**
     * Get password_again
     *
     * @return string
     */
    public function getPasswordAgain() {
        return $this->password_again;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuario
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set tokenRegistro
     *
     * @param string $tokenRegistro
     * @return Usuario
     */
    public function setTokenRegistro($tokenRegistro)
    {
        $this->tokenRegistro = $tokenRegistro;

        return $this;
    }

    /**
     * Get tokenRegistro
     *
     * @return string 
     */
    public function getTokenRegistro()
    {
        return $this->tokenRegistro;
    }

    /**
     * Add notas
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota $notas
     * @return Usuario
     */
    public function addNota(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota $notas)
    {
        $this->notas[] = $notas;

        return $this;
    }

    /**
     * Remove notas
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota $notas
     */
    public function removeNota(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota $notas)
    {
        $this->notas->removeElement($notas);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Add contratos
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos
     * @return Usuario
     */
    public function addContrato(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos)
    {
        $this->contratos[] = $contratos;

        return $this;
    }

    /**
     * Remove contratos
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos
     */
    public function removeContrato(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos)
    {
        $this->contratos->removeElement($contratos);
    }

    /**
     * Get contratos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContratos()
    {
        return $this->contratos;
    }

    /**
     * Add etiquetas
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas
     * @return Usuario
     */
    public function addEtiqueta(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas[] = $etiquetas;

        return $this;
    }

    /**
     * Remove etiquetas
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas
     */
    public function removeEtiqueta(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas->removeElement($etiquetas);
    }

    /**
     * Get etiquetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }

    /**
     * Add grupos
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Grupo $grupos
     * @return Usuario
     */
    public function addGrupo(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Grupo $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Grupo $grupos
     */
    public function removeGrupo(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Grupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    public function eraseCredentials()
    {

    }

    public function getRoles()
    {
        $roles = array();
        foreach ($this->grupos as $g)
        {
            $roles[] = $g->getRol();
        }

        return $roles;
    }

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
        return $this->getIsActive();
    }

    /**
     * @Assert\True(message = "Has escrito dos password distintos")
     */
    public function isPasswordOK() {
        return ($this->password === $this->password_again);
    }

    public function __toString(){
        return $this->username;
    }
}
