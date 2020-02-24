<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commandeF
 *
 * @ORM\Table(name="commandef")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\commandeFRepository")
 */
class commandeF
{
    /**
     * @var int
     *
     * @ORM\Column(name="idm", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idm;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Societe")
     * @ORM\JoinColumn(name="ids",referencedColumnName="ids")
     */

    private $ids;

    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="idp",referencedColumnName="idp")
     */

    private $idp;



    /**
     * Get idm
     *
     * @return int
     */
    public function getIdm()
    {
        return $this->idm;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return commandeF
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }



    /**
     * @return mixed
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param mixed $ids
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return mixed
     */
    public function getIdp()
    {
        return $this->idp;
    }

    /**
     * @param mixed $idp
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }




}
