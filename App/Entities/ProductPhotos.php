<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPhotos
 *
 * @ORM\Table(name="product_photos", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductPhotos
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
     * @var string
     *
     * @ORM\Column(name="type", type="string",length=255, nullable=true)
     */
    private $type;
	
	  /**
     * @var string
     *
     * @ORM\Column(name="url", type="string",length=255, nullable=true)
     */
    private $url;
	
	
   
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
     * @return ProductPhotos
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
     * Set url
     *
     * @param string $url
     *
     * @return ProductPhotos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
   
   /**
     * Set type
     *
     * @param string $type
     *
     * @return ProductPhotos
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
     * Set status
     *
     * @param integer $status
     *
     * @return ProductPhotos
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

