<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndigenousToken
 *
 * @ORM\Table(name="indigenous_token")
 * @ORM\Entity
 */
class IndigenousToken
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="int", nullable=false)
     * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;
 /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;
 /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;


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
     * Set username
     *
     * @param string $username
     *
     * @return IndigenousToken
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
  /**
     * Set password
     *
     * @param string $password
     *
     * @return IndigenousToken
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
  /**
     * Set token
     *
     * @param string $token
     *
     * @return IndigenousToken
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
 
}

