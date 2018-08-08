<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCommunityGroup
 *
 * @ORM\Table(name="product_community_group", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
 
 
class ProductCommunityGroup
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
     * @ORM\Column(name="community_group_id",type="integer", options={"comment":"From drop_down_master table "})
	 * @ORM\ManyToOne(targetEntity="App\Entities\Products", inversedBy="product")
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $community_group_id;

   
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
     * @return ProductCommunityGroup
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
     * Set community_group_id
     *
     * @param integer $community_group_id
     *
     * @return ProductCommunityGroup
     */
    public function setCommunityGroupId($community_group_id)
    {
        $this->community_group_id = $community_group_id;

        return $this;
    }

    /**
     * Get community_group_id
     *
     * @return integer
     */
    public function getCommunityGroupId()
    {
        return $this->community_group_id;
    }

   
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return ProductCommunityGroup
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

