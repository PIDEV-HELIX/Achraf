<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieF
 *
 * @ORM\Table(name="categorief")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CategorieFRepository")
 */

class CategorieF
{
    /**
     * @var int
     *
     * @ORM\Column(name="idf", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idf;

    /**
     * @var string
     *
     * @ORM\Column(name="nomC", type="string", length=255)
     */
    private $nomC;

    /**
     * @param int $idf
     */
    public function setIdf($idf)
    {
        $this->idf = $idf;
    }


    /**
     * Get idf
     *
     * @return int
     */
    public function getIdf()
    {
        return $this->idf;
    }

    /**
     * Set nomC
     *
     * @param string $nomC
     *
     * @return categorieF
     */
    public function setNomC($nomC)
    {
        $this->nomC = $nomC;

        return $this;
    }

    /**
     * Get nomC
     *
     * @return string
     */
    public function getNomC()
    {
        return $this->nomC;
    }

}