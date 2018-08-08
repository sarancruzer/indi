<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bookings
 *
 * @ORM\Table(name="bookings")
 * @ORM\Entity
 */
class Bookings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
	 * @ORM\OneToMany(targetEntity="App\Entities\BookingInvoiceDetails", mappedBy="booking")
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
     * @ORM\Column(name="people_total",type="integer")
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $people_total;

   /**
	 * @var string
     * @ORM\Column(name="under_18",type="string",length=5)
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $under_18;
	/**
	 * @var string
     * @ORM\Column(name="ages",type="string",length=255)
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $ages;

   /**
	 * @var string
     * @ORM\Column(name="booking_status",type="string",length=255)
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $booking_status;
	/**
	 * @var string
     * @ORM\Column(name="confirmation_number",type="string",length=255)
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $confirmation_number;

   
    /**
     * @var integer
     *
     * @ORM\Column(name="booked_by", type="smallint", nullable=true, options={"comment":"From user table "})
     */
    private $booked_by;

  
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="booked_on", type="datetime", nullable=true)
     */
    private $booked_on;

	
  
	
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
     * @return Bookings
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
     * Set people_total
     *
     * @param integer $people_total
     *
     * @return Bookings
     */
    public function setPeopleTotal($people_total)
    {
        $this->people_total = $people_total;

        return $this;
    }

    /**
     * Get people_total
     *
     * @return integer
     */
    public function getPeopleTotal()
    {
        return $this->people_total;
    }
	/**
     * Set under_18
     *
     * @param string $under_18
     *
     * @return Bookings
     */
    public function setUnder18($under_18)
    {
        $this->under_18 = $under_18;

        return $this;
    }

    /**
     * Get under_18
     *
     * @return string
     */
    public function getUnder18()
    {
        return $this->under_18;
    }
	/**
     * Set booking_status
     *
     * @param string $booking_status
     *
     * @return Bookings
     */
    public function setBookingStatus($booking_status)
    {
        $this->booking_status = $booking_status;

        return $this;
    }

    /**
     * Get booking_status
     *
     * @return string
     */
    public function getBookingStatus()
    {
        return $this->booking_status;
    }
	/**
     * Set confirmation_number
     *
     * @param string $confirmation_number
     *
     * @return Bookings
     */
    public function setConfimationNumber($confirmation_number)
    {
        $this->confirmation_number = $confirmation_number;

        return $this;
    }

    /**
     * Get confirmation_number
     *
     * @return string
     */
    public function getConfimationNumber()
    {
        return $this->confirmation_number;
    }

   
	
	
	/**
     * Set booked_by
     *
     * @param integer $booked_by
     *
     * @return Bookings
     */
    public function setBookedBy($booked_by)
    {
        $this->booked_by = $booked_by;

        return $this;
    }

    /**
     * Get booked_by
     *
     * @return integer
     */
    public function getBookedBy()
    {
        return $this->booked_by;
    }

    /**
     * Set booked_on
     *
     * @param \DateTime $booked_on
     *
     * @return Bookings
     */
    public function setBookedOn($booked_on)
    {
        $this->booked_on = $booked_on;

        return $this;
    }

    /**
     * Get booked_on
     *
     * @return \DateTime
     */
    public function getBookedOn()
    {
        return $this->booked_on;
    }
   
   
   
}

