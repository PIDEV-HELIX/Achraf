<?php

namespace ShopBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * livr
 *
 * @ORM\Table(name="livr")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\LivrRepository")
 */
class Livr
{
    /**
     * @var int
     *
     * @ORM\Column(name="idv", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idv;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="namev", type="string", length=255)
     */
    private $namev;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     *
     * @ORM\Column(name="cite", type="string", length=255)
     */
    private $cite;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     *
     * @ORM\Column(name="codep", type="string", length=255)
     */
    private $codep;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $emailv;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="modelivrraison", type="string", length=255)
     */
    private $modelivrraison;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @return int
     */
    public function getIdv()
    {
        return $this->idv;
    }

    /**
     * @param int $idv
     */
    public function setIdv($idv)
    {
        $this->idv = $idv;
    }

    /**
     * @return string
     */
    public function getNamev()
    {
        return $this->namev;
    }

    /**
     * @param string $namev
     */
    public function setNamev($namev)
    {
        $this->namev = $namev;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCite()
    {
        return $this->cite;
    }

    /**
     * @param string $cite
     */
    public function setCite($cite)
    {
        $this->cite = $cite;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getCodep()
    {
        return $this->codep;
    }

    /**
     * @param string $codep
     */
    public function setCodep($codep)
    {
        $this->codep = $codep;
    }

    /**
     * @return string
     */
    public function getEmailv()
    {
        return $this->emailv;
    }

    /**
     * @param string $emailv
     */
    public function setEmailv($emailv)
    {
        $this->emailv = $emailv;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getModelivrraison()
    {
        return $this->modelivrraison;
    }

    /**
     * @return bool
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $modelivrraison
     */
    public function setModelivrraison($modelivrraison)
    {
        $this->modelivrraison = $modelivrraison;
    }


}

