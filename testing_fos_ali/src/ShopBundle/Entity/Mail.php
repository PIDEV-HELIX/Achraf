<?php

namespace ShopBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use mysql_xdevapi\TableUpdate;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\MailRepository")
 */
class Mail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="mailto", type="string", length=255)
     *
     */
    private $mailto;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="subject", type="string", length=255)
     *
     */
    private $subject;

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var string
     * @Assert\NotBlank(message="Field cannot be empty!")
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @return string
     */
    public function getMailfrom()
    {
        return $this->mailfrom;
    }

    /**
     * @param string $mailfrom
     */
    public function setMailfrom($mailfrom)
    {
        $this->mailfrom = $mailfrom;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="mailfrom", type="string", length=255)
     */
    private $mailfrom;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Soc")
     * @ORM\JoinColumn(name="ids", referencedColumnName="ids")
     */
    private $ids;

    /**
     * Set ids
     *
     * @param integer $ids
     *
     * @return Mail
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mailto
     *
     * @param string $mailto
     *
     * @return Mail
     */
    public function setMailto($mailto)
    {
        $this->mailto = $mailto;

        return $this;
    }

    /**
     * Get mailto
     *
     * @return string
     */
    public function getMailto()
    {
        return $this->mailto;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Mail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set object
     *
     * @param string $object
     *
     * @return Mail
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }
}

