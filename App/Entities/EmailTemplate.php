<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailTemplate
 *
 * @ORM\Table(name="email_template", indexes={@ORM\Index(name="email_slug", columns={"email_slug"})})
 * @ORM\Entity
 */
class EmailTemplate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email_slug", type="string", length=255, nullable=false)
     */
    private $emailSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="to_email", type="text", length=65535, nullable=false)
     */
    private $toEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="cc_email", type="text", length=65535, nullable=false)
     */
    private $ccEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="bcc_email", type="text", length=65535, nullable=false)
     */
    private $bccEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="email_subject", type="text", length=65535, nullable=false)
     */
    private $emailSubject;

    /**
     * @var string
     *
     * @ORM\Column(name="email_message", type="text", length=65535, nullable=false)
     */
    private $emailMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=false)
     */
    private $updatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     */
    private $updatedOn;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailSlug
     *
     * @param string $emailSlug
     *
     * @return EmailTemplate
     */
    public function setEmailSlug($emailSlug)
    {
        $this->emailSlug = $emailSlug;

        return $this;
    }

    /**
     * Get emailSlug
     *
     * @return string
     */
    public function getEmailSlug()
    {
        return $this->emailSlug;
    }

    /**
     * Set toEmail
     *
     * @param string $toEmail
     *
     * @return EmailTemplate
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    /**
     * Get toEmail
     *
     * @return string
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * Set ccEmail
     *
     * @param string $ccEmail
     *
     * @return EmailTemplate
     */
    public function setCcEmail($ccEmail)
    {
        $this->ccEmail = $ccEmail;

        return $this;
    }

    /**
     * Get ccEmail
     *
     * @return string
     */
    public function getCcEmail()
    {
        return $this->ccEmail;
    }

    /**
     * Set bccEmail
     *
     * @param string $bccEmail
     *
     * @return EmailTemplate
     */
    public function setBccEmail($bccEmail)
    {
        $this->bccEmail = $bccEmail;

        return $this;
    }

    /**
     * Get bccEmail
     *
     * @return string
     */
    public function getBccEmail()
    {
        return $this->bccEmail;
    }

    /**
     * Set emailSubject
     *
     * @param string $emailSubject
     *
     * @return EmailTemplate
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;

        return $this;
    }

    /**
     * Get emailSubject
     *
     * @return string
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * Set emailMessage
     *
     * @param string $emailMessage
     *
     * @return EmailTemplate
     */
    public function setEmailMessage($emailMessage)
    {
        $this->emailMessage = $emailMessage;

        return $this;
    }

    /**
     * Get emailMessage
     *
     * @return string
     */
    public function getEmailMessage()
    {
        return $this->emailMessage;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return EmailTemplate
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return EmailTemplate
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return EmailTemplate
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     *
     * @return EmailTemplate
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     *
     * @return EmailTemplate
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}

