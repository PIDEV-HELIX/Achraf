<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieR
 *
 * @ORM\Table(name="categorier")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CategorieRRepository")
 */

class CategorieR
{
    /**
     * @var int
     *
     * @ORM\Column(name="idc", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idc;

    /**
     * @var string
     *
     * @ORM\Column(name="nomR", type="string", length=255)
     */
    private $nomR;

    /**
     * @param int $idc
     */
    public function setId($idc)
    {
        $this->idc = $idc;
    }


    /**
     * Get idc
     *
     * @return int
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * Set nomR
     *
     * @param string $nomR
     *
     * @return categorieR
     */
    public function setNomR($nomR)
    {
        $this->nomR = $nomR;

        return $this;
    }

    /**
     * Get nomR
     *
     * @return string
     */
    public function getNomR()
    {
        return $this->nomR;
    }

}