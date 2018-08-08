<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductFacility
 *
 * @ORM\Table(name="product_facility", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductFacility
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
     * @ORM\Column(name="product_id",type="integer", options={"comment":"From products table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $product_id;
	/**
	 * @var integer
     * @ORM\Column(name="facility_id",type="integer", options={"comment":"From drop_down_master table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $facility_id;

   
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
     * Set product_id
     *
     * @param integer $product_id
     *
     * @return Productfacility
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->product_id;
    }

   
    /**
     * Set facility_id
     *
     * @param integer $facility_id
     *
     * @return Productfacility
     */
    public function setFacilityId($facility_id)
    {
        $this->facility_id = $facility_id;

        return $this;
    }

    /**
     * Get facility_id
     *
     * @return integer
     */
    public function getFacilityId()
    {
        return $this->facility_id;
    }

   
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return Productfacility
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

