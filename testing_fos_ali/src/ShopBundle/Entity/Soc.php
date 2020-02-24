<?php

namespace ShopBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Soc
 *
 * @ORM\Table(name="soc")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\SocRepository")
 */
class Soc
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;


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
     * Set names
     *
     * @param string $names
     *
     * @return Soc
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
     * @return Soc
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
     * @return Soc
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
     * @return Soc
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
     * Set description
     *
     * @param string $description
     *
     * @return Soc
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Soc
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

