<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PricingConfigMaster
 *
 * @ORM\Table(name="pricing_config_master")
 * @ORM\Entity
 */
class PricingConfigMaster
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
     * @var string
     *
     * @ORM\Column(name="icon", type="string",length=255, nullable=true)
     */
    private $icon;
	
	
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
     * @return PricingConfigMaster
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
     * @return PricingConfigMaster
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

   
   
}

