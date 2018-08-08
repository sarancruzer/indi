<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DropDownMaster
 *
 * @ORM\Table(name="drop_down_master")
 * @ORM\Entity
 */
class DropDownMaster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductCategory", mappedBy="category")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductFacility", mappedBy="facility")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

      /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

   
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=true)
     */
    private $status;

   
     /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;
	/**
     * @var string
     *
     * @ORM\Column(name="icon", type="string",length=255, nullable=true)
     */
	 
	private $icon;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="module", type="string",length=255, nullable=true)
     */ 
	
	 private $module;
	/**
     * Get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * Set name
     *
     * @param string $name
     *
     * @return DropDownMaster
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

   
    /**
     * Set Description
     *
     * @param string $description
     *
     * @return DropDownMaster
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return DropDownMaster
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
     * Set type
     *
     * @param string $type
     *
     * @return DropDownMaster
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
	
	/**
     * Set module
     *
     * @param string $module
     *
     * @return DropDownMaster
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return DropDownMaster
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

   
   
}

