<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplierReviews
 *
 * @ORM\Table(name="supplier_reviews", indexes={@ORM\Index(name="fk26_supplier_id_idx", columns={"supplier_id"})})
 * @ORM\Entity
 */
class SupplierReviews
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
     * @ORM\Column(name="supplier_id",type="integer", options={"comment":"From user table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $supplier_id;
   
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
     * @ORM\Column(name="rated_by", type="integer", nullable=true, options={"comment":"From user table "})
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
     * Set supplier_id
     *
     * @param integer $supplier_id
     *
     * @return Supplierfacility
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
     * Set title
     *
     * @param string $title
     *
     * @return SupplierReviews
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
     * @return SupplierReviews
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
     * @return SupplierReviews
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
     * @return SupplierReviews
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

