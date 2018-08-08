<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingInvoiceDetails
 *
 * @ORM\Table(name="booking_invoice_details", indexes={@ORM\Index(name="fk26_booking_id_idx", columns={"booking_id"})})
 * @ORM\Entity
 */
class BookingInvoiceDetails
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
     * @ORM\Column(name="booking_id",type="integer")
	 */	
    private $booking_id;
	
	
	/**
	
     * @var integer
     * @ORM\Column(name="invoice_number",type="integer", options={"comment":"From bookings table "})
	 */	
	 
    private $invoice_number;

   /**
	 * @var string
     * @ORM\Column(name="description",type="string",length=2255, nullable=true)
	 */	
    private $description;
	
  
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_date", type="datetime", nullable=true)
     */
    private $invoice_date;

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
     * Set booking_id
     *
     * @param integer $booking_id
     *
     * @return BookingInvoiceDetails
     */
    public function setBookingId($booking_id)
    {
        $this->booking_id = $booking_id;

        return $this;
    }

    /**
     * Get booking_id
     *
     * @return integer
     */
    public function getBookingId()
    {
        return $this->booking_id;
    }

   
    /**
     * Set invoice_number
     *
     * @param integer $invoice_number
     *
     * @return BookingInvoiceDetails
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    /**
     * Get invoice_number
     *
     * @return integer
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }
	/**
     * Set description
     *
     * @param string $description
     *
     * @return BookingInvoiceDetails
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
	
   
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return BookingInvoiceDetails
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
	

    /**
     * Set invoice_date
     *
     * @param \DateTime $booked_on
     *
     * @return bookings
     */
    public function setInvoiceDate($invoice_date)
    {
        $this->invoice_date = $invoice_date;

        return $this;
    }

    /**
     * Get invoice_date
     *
     * @return \DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoice_date;
    }
   
   
   
}

