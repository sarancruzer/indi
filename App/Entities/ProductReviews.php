<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductReviews
 *
 * @ORM\Table(name="product_reviews", indexes={@ORM\Index(name="fk26_product_id_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductReviews
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

   
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="smallint", nullable=true)
     */
    private $rating;
	 /**
	 * @var integer
     *
     * @ORM\Column(name="rated_by", type="integer", nullable=true)
     */
    private $rated_by;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rated_on", type="datetime", nullable=true)
     */
    private $rated_on;
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
     * Set title
     *
     * @param string $title
     *
     * @return ProductReviews
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

   
    /**
     * Set Description
     *
     * @param string $description
     *
     * @return ProductReviews
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
     * Set rating
     *
     * @param integer $rating
     *
     * @return ProductReviews
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
	/**
     * Set rated_by
     *
     * @param integer $rated_by
     *
     * @return TagMaster
     */
    public function setRatedBy($rated_by)
    {
        $this->rated_by = $rated_by;

        return $this;
    }

    /**
     * Get rated_by
     *
     * @return integer
     */
    public function getRatedBy()
    {
        return $this->rated_by;
    }

    /**
     * Set rated_on
     *
     * @param \DateTime $rated_on
     *
     * @return TagMaster
     */
    public function setRatedOn($rated_on)
    {
        $this->rated_on = $rated_on;

        return $this;
    }

    /**
     * Get rated_on
     *
     * @return \DateTime
     */
    public function getRatedOn()
    {
        return $this->rated_on;
    }
/**
     * Set status
     *
     * @param integer $status
     *
     * @return ProductReviews
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

