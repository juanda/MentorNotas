<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarifa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\TarifaRepository")
 */
class Tarifa
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
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodo", type="integer")
     */
    private $periodo;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validoDesde", type="date")
     */
    private $validoDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validoHasta", type="date")
     */
    private $validoHasta;

    ////ASOCIACIONES////

    /**
     * @ORM\OneToMany(targetEntity="Contrato", mappedBy="tarifa")
     */
    private $contratos;

    ////FIN ASOCIACIONES////

    public function __construct()
    {
        $this->contratos = new ArrayCollection();
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
     * @return Tarifa
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
     * Set periodo
     *
     * @param integer $periodo
     * @return Tarifa
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return integer 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Tarifa
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set validoDesde
     *
     * @param \DateTime $validoDesde
     * @return Tarifa
     */
    public function setValidoDesde($validoDesde)
    {
        $this->validoDesde = $validoDesde;

        return $this;
    }

    /**
     * Get validoDesde
     *
     * @return \DateTime 
     */
    public function getValidoDesde()
    {
        return $this->validoDesde;
    }

    /**
     * Set validoHasta
     *
     * @param \DateTime $validoHasta
     * @return Tarifa
     */
    public function setValidoHasta($validoHasta)
    {
        $this->validoHasta = $validoHasta;

        return $this;
    }

    /**
     * Get validoHasta
     *
     * @return \DateTime 
     */
    public function getValidoHasta()
    {
        return $this->validoHasta;
    }

    /**
     * Add contratos
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos
     * @return Tarifa
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
}
