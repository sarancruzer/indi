<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCategory
 *
 * @ORM\Table(name="product_category", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductCategory
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
	 * @ORM\ManyToOne(targetEntity="App\Entities\Products", inversedBy="product")
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $product_id;
 /**
	
     * @var integer
     * @ORM\Column(name="category_id",type="integer", options={"comment":"From drop_down_master table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $category_id;

   
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
     * @return ProductCategory
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
     * Set category_id
     *
     * @param integer $category_id
     *
     * @return ProductCategory
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

   
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return ProductCategory
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

