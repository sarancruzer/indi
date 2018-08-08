<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductTags
 *
 * @ORM\Table(name="product_tags", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductTags
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
     * @ORM\Column(name="tag_id",type="integer", options={"comment":"From tag_master table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $tag_id;

   
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
     * @return ProductTags
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
     * Set tag_id
     *
     * @param integer $tag_id
     *
     * @return ProductTags
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;

        return $this;
    }

    /**
     * Get tag_id
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tag_id;
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

