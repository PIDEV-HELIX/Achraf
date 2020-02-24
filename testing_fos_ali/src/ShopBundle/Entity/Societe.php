<?php

namespace ShopBundle\Entity;
use ShopBundle\Entity\CategorieF;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\SocieteRepository")
 */
class Societe
{
    /**
     * @var int
     *
     * @ORM\Column(name="ids", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ids;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="names", type="string", length=255)
     */
    private $names;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="CategorieF")
     * @ORM\JoinColumn(name="idf", referencedColumnName="idf")
     */

    private $idf;

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
     * Set ids
     *
     * @param integer $ids
     *
     * @return Societe
     */
    public function setId($ids)
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
     * @param int $ids
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
    }

    /**
     * @param mixed $idf
     */
    public function setIdf($idf)
    {
        $this->idf = $idf;
    }


    /**
     * Set names
     *
     * @param string $names
     *
     * @return Societe
     */
    public function setNames($names)
    {
        $this->names = $names;

        return $this;
    }

    /**
     * Get names
     *
     * @return string
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Societe
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Societe
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
     * Set tel
     *
     * @param string $tel
     *
     * @return Societe
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }


    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Societe
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}

