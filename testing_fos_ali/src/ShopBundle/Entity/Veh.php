<?php

namespace ShopBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Veh
 *
 * @ORM\Table(name="veh")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\VehRepository")
 */
class Veh
{
    /**
     * @var int
     *
     * @ORM\Column(name="idad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idad;



    /**
     * @var string
     *
     * @ORM\Column(name="ad", type="string", length=255)
     */
    private $ad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debutcontrat", type="datetime")
     */
    private $debutcontrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fincontrat", type="datetime")
     */
    private $fincontrat;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255)
     */

    private $serie;
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Soc")
     * @ORM\JoinColumn(name="ids", referencedColumnName="ids")
     */

    private $ids;


    /**
     * Get idad
     *
     * @return int
     */
    public function getIdad()
    {
        return $this->idad;
    }




    /**
     * Set ad
     *
     * @param string $ad
     *
     * @return Veh
     */
    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return string
     */
    public function getAd()
    {
        return $this->ad;
    }








    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return Veh
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDebutcontrat()
    {
        return $this->debutcontrat;
    }

    /**
     * @param \DateTime $debutcontrat
     */
    public function setDebutcontrat($debutcontrat)
    {
        $this->debutcontrat = $debutcontrat;
    }

    /**
     * @return \DateTime
     */
    public function getFincontrat()
    {
        return $this->fincontrat;
    }

    /**
     * @param \DateTime $fincontrat
     */
    public function setFincontrat($fincontrat)
    {
        $this->fincontrat = $fincontrat;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set ids
     *
     * @param integer $ids
     *
     * @return Veh
     */
    public function setIds($ids)
    {
        $this->ids = $ids;

        return $this;
    }

    /**
     * Get ids
     *
     * @return int
     */
    public function getIds()
    {
        return $this->ids;
    }
    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}

