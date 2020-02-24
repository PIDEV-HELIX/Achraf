<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commandeP
 *
 * @ORM\Table(name="commandep")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\commandePRepository")
 */
class commandeP
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcm", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcm;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="modepay", type="string", length=255)
     */

    private $modepay;

    /**
     * @return mixed
     */
    public function getIdn()
    {
        return $this->idn;
    }

    /**
     * @param mixed $idn
     */
    public function setIdn($idn)
    {
        $this->idn = $idn;
    }

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Panier")
     * @ORM\JoinColumn(name="idn", referencedColumnName="idn")
     */

    private $idn;

    /**
     * @return string
     */
    public function getModepay()
    {
        return $this->modepay;
    }

    /**
     * @param string $modepay
     */
    public function setModepay($modepay)
    {
        $this->modepay = $modepay;
    }


    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get idcm
     *
     * @return int
     */
    public function getIdcm()
    {
        return $this->idcm;
    }
}

