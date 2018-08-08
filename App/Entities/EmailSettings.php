<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailSettings
 *
 * @ORM\Table(name="email_settings")
 * @ORM\Entity
 */
class EmailSettings
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
     * @ORM\Column(name="from_name", type="string", length=150, nullable=false)
     */
    private $fromName;

    /**
     * @var string
     *
     * @ORM\Column(name="from_email", type="text", length=65535, nullable=false)
     */
    private $fromEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="group_email", type="text", length=65535, nullable=false)
     */
    private $groupEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="admin_email", type="text", length=65535, nullable=false)
     */
    private $adminEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status = '0';

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
     * Set fromName
     *
     * @param string $fromName
     *
     * @return EmailSettings
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set fromEmail
     *
     * @param string $fromEmail
     *
     * @return EmailSettings
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * Get fromEmail
     *
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set groupEmail
     *
     * @param string $groupEmail
     *
     * @return EmailSettings
     */
    public function setGroupEmail($groupEmail)
    {
        $this->groupEmail = $groupEmail;

        return $this;
    }

    /**
     * Get groupEmail
     *
     * @return string
     */
    public function getGroupEmail()
    {
        return $this->groupEmail;
    }

    /**
     * Set adminEmail
     *
     * @param string $adminEmail
     *
     * @return EmailSettings
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;

        return $this;
    }

    /**
     * Get adminEmail
     *
     * @return string
     */
    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return EmailSettings
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
}

