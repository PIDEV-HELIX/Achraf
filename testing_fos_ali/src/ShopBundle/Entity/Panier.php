<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="idn", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idn;

    /**
     * @var string
     *
     * @ORM\Column(name="somme", type="string", length=255)
     */
    private $somme;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="string", length=255)
     */
    private $quantite;


    /**
     * Get idn
     *
     * @return int
     */
    public function getIdn()
    {
        return $this->idn;
    }

    /**
     * Set somme
     *
     * @param string $somme
     *
     * @return Panier
     */
    public function setSomme($somme)
    {
        $this->somme = $somme;

        return $this;
    }

    /**
     * Get somme
     *
     * @return string
     */
    public function getSomme()
    {
        return $this->somme;
    }

    /**
     * Set quantite
     *
     * @param string $quantite
     *
     * @return Panier
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}

