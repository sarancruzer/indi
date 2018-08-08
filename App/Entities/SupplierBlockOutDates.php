<?php

Namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplierBlockOutDates
 *
 * @ORM\Table(name="supplier_block_out_dates", indexes={@ORM\Index(name="fk26_supplier_id_idx", columns={"supplier_id"})})
 * @ORM\Entity
 */
class SupplierBlockOutDates
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
     * @ORM\ManyToOne(targetEntity="App\Entities\User",inversedBy="SupplierId")
     * @ORM\Column(name="supplier_id",type="integer", options={"comment":"From user table "})
	 * @ORM\JoinColumn(nullable=true)
     */	
    private $supplier_id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string",length=255, nullable=true)
     */
    private $type;
	
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value; 
	
	/**
     * @var string
     *
     * @ORM\Column(name="to_value", type="string", length=255, nullable=true)
     */
    private $to_value;

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
     * @return SupplierBlockOutDates
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
     * Set type
     *
     * @param string $type
     *
     * @return SupplierBlockOutDates
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
     * Set to_value
     *
     * @param string $to_value
     *
     * @return SupplierBlockOutDates
     */  
    public function setToValue($to_value)
    {
        $this->to_value = $to_value;

        return $this;
    }

    /**
     * Get to_value
     *
     * @return string
     */
    public function getToValue()
    {
        return $this->to_value;
    }
	 
	 /**
     * Set value
     *
     * @param string $value
     *
     * @return SupplierBlockOutDates
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
	
	/**
     * Set status
     *
     * @param integer $status
     *
     * @return SupplierBlockOutDates
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

