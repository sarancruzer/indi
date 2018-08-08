<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductTimeSlots
 *
 * @ORM\Table(name="product_time_slots", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductTimeSlots
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
     * @ORM\ManyToOne(targetEntity="App\Entities\Product",inversedBy="ProductId")
     * @ORM\Column(name="product_id",type="integer", options={"comment":"From products table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $product_id;

    
    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=255, nullable=true)
     */
    private $time;

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
     * @return ProductTimeSlots
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
     * Set time
     *
     * @param string $time
     *
     * @return ProductTimeSlots
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
	
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return ProductTimeSlots
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

