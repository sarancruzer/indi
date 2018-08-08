<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="fk26_role_id_idx", columns={"role_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
	 * @ORM\OneToMany(targetEntity="App\Entities\Products", mappedBy="supplier")
	 * @ORM\OneToMany(targetEntity="App\Entities\Bookings", mappedBy="user")
	 * @ORM\OneToMany(targetEntity="App\Entities\SupplierReviews", mappedBy="supplier")
	 * @ORM\OneToMany(targetEntity="App\Entities\SupplierBlockOutDates", mappedBy="supplier")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    private $first_name;
	
	/**
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", length=255, nullable=false)
     */
    private $business_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\RoleMaster", inversedBy="id")
     * @ORM\Column(name="role_id", type="integer", nullable=true, options={"comment":"From role_master table "})
     * @ORM\JoinColumn(nullable=true)
     */
    private $role_id;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_key", type="string", length=255, nullable=true)
     */
    private $auth_key;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;
	
	/**
     * @var string
     *
     * @ORM\Column(name="forgot_password_key", type="string", length=255, nullable=true)
     */
	 
	 
	private $forgot_password_key;
	
	/**
     * @var string
     *
     * @ORM\Column(name="contact_number", type="string", length=255, nullable=true)
     */
	 

	 
    private $contact_number;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
	 
	 
	private $activation_key;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */ 
    private $password;

    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="prfl_img", type="string", length=255, nullable=true)
     */
    private $prfl_img;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $created_by;
	
	 /**
     * @var integer
     *
     * @ORM\Column(name="is_deleted", type="integer", nullable=true)
     */
    private $is_deleted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $created_on;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    private $updated_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updated_on;


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
     * Set business_name
     *
     * @param string $business_name
     *
     * @return User
     */
    public function setBusinessName($business_name)
    {
        $this->business_name = $business_name;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->business_name;
    }

    /**
     * Set first_name
     *
     * @param string $first_name
     *
     * @return User
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $last_name
     *
     * @return User
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set contact_number
     *
     * @param string $contact_number
     *
     * @return contact_number
     */
    public function setContactnumber($contact_number)
    {
        $this->contact_number = $contact_number;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getConatctnumber()
    {
        return $this->contact_number;
    }
	
	/**
     * Set username
     *
     * @param string $username
     *
     * @return User
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
     * Set role_id
     *
     * @param integer $role_id
     *
     * @return User
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get role_id
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set auth_key
     *
     * @param string $auth_key
     *
     * @return User
     */
    public function setAuthKey($auth_key)
    {
        $this->auth_key = $auth_key;

        return $this;
    }

    /**
     * Get auth_key
     *
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
	
	
	/**
     * Set token
     *
     * @param string $token
     *
     * @return User
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
	
	 /**
     * Set activation_key
     *
     * @param string $auth_key
     *
     * @return User
     */
    public function setActivationKey($activation_key)
    {
        $this->activation_key = $activation_key;

        return $this;
    }

    /**
     * Get activation_key
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activation_key;
    }
	
	 /**
     * Set forgot_password_key
     *
     * @param string $forgot_password_key
     *
     * @return User
     */
    public function setForgotpasswordkey($forgot_password_key)
    {
        $this->forgot_password_key = $forgot_password_key;

        return $this;
    }

    /**
     * Get forgot_password_key
     *
     * @return string
     */
    public function getForgotpasswordkey()
    {
        return $this->forgot_password_key;
    }

    /**
     * Set passwordHash
     *
     * @param string $passwordHash
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get passwordHash
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set email
     *
     * @param string $prfl_img
     *
     * @return User
     */
    public function setPrflImg($prfl_img)
    {
        $this->prfl_img = $prfl_img;

        return $this;
    }

    /**
     * Get prfl_img
     *
     * @return string
     */
    public function getPrflImg()
    {
        return $this->prfl_img;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created_by
     *
     * @param integer $created_by
     *
     * @return User
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set created_on
     *
     * @param \DateTime $created_on
     *
     * @return User
     */
    public function setCreatedOn($created_on)
    {
        $this->created_on = $created_on;

        return $this;
    }

    /**
     * Get created_on
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * Set updated_by
     *
     * @param integer $updated_by
     *
     * @return User
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;

        return $this;
    }
	

    /**
     * Get updated_by
     *
     * @return integer
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }
	
	/**
     * Set is_deleted
     *
     * @param integer $is_deleted
     *
     * @return User
     */
    public function setIsDeleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    /**
     * Get is_deleted
     *
     * @return integer
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set updated_on
     *
     * @param \DateTime $updated_on
     *
     * @return User
     */
    public function setUpdatedOn($updated_on)
    {
        $this->updated_on = $updated_on;

        return $this;
    }

    /**
     * Get updated_on
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updated_on;
    }
}

