<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuplierModule
 *
 * @ORM\Table(name="supplier_module", indexes={@ORM\Index(name="fk26_supplier_id_idx", columns={"supplier_id"})})
 * @ORM\Entity
 */
class SuplierModule
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
	
     * @var integer
     * @ORM\Column(name="supplier_id",type="integer", options={"comment":"From User table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $supplier_id;
 /**
	
     * @var string
     * @ORM\Column(name="module",type="string", nullable=true)
     */	
    private $module;

   
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=true)
     */
    private $status;

  
	
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
     * Set supplier_id
     *
     * @param integer $supplier_id
     *
     * @return ProductTags
     */
    public function setSupplierId($supplier_id)
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    /**
     * Get supplier_id
     *
     * @return integer
     */
    public function getSupplierId()
    {
        return $this->supplier_id;
    }

   
    /**
     * Set module
     *
     * @param integer $module
     *
     * @return ProductTags
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
     * Set status
     *
     * @param integer $status
     *
     * @return ProductTags
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

