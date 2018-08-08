<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="fk26_supplier_id_idx", columns={"supplier_id"})})
 * @ORM\Entity
 */
class Products
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductPhotos", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductTags", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductCategory", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductFacility", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductReviews", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductTimeSlots", mappedBy="product")
	 * @ORM\OneToMany(targetEntity="App\Entities\ProductBlockOutDates", mappedBy="product")
	 * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

     /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=255, nullable=true)
     */
    private $module;

    
    /**
     * @var string
     *
     * @ORM\Column(name="session_capacity", type="string", length=255, nullable=true)
     */
    private $session_capacity;
	
	 /**
     * @var integer
     *
     * @ORM\Column(name="session_member", type="integer", nullable=true)
     */
    private $session_member;
	 /**
     * @var integer
     *
     * @ORM\Column(name="min_people", type="integer", nullable=true)
     */
    private $min_people;
	 /**
     * @var integer
     *
     * @ORM\Column(name="max_people", type="integer", nullable=true)
     */
    private $max_people;
	
	/**
     * @var string
     *
     * @ORM\Column(name="under_18_allowed", type="string", length=2255, nullable=true)
     */
    private $under_18_allowed;
	/**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=2255, nullable=true)
     */
    private $info;

	/**
     * @var string
     *
     * @ORM\Column(name="what_to_bring", type="string", length=2255, nullable=true)
     */
    private $what_to_bring;

	/**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=2255, nullable=true)
     */
    private $conditions;

	/**
     * @var string
     *
     * @ORM\Column(name="rules", type="string", length=2255, nullable=true)
     */
    private $rules;
	/**
     * @var string
     *
     * @ORM\Column(name="fineprint", type="string", length=2255, nullable=true)
     */
    private $fineprint;

	/**
     * @var string
     *
     * @ORM\Column(name="location", type="string",length=255, nullable=true)
     */
    private $location;
	/**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string",length=255, nullable=true)
     */
    private $latitude;
	/**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string",length=255, nullable=true)
     */
    private $longitude;
	/**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", nullable=true)
     */
    private $cost;
	
    /**
     * @var string
     *
     * @ORM\Column(name="cost_type", type="string",length=255, nullable=true)
     */
    private $cost_type;
	 /**
     * @var integer
     *
     * @ORM\Column(name="duration_value", type="integer", nullable=true)
     */
    private $duration_value;
	 /**
     * @var string
     *
     * @ORM\Column(name="duration_type", type="string",length=255, nullable=true)
     */
    private $duration_type;
	 /**
     * @var string
     *
     * @ORM\Column(name="check_in", type="string",length=255, nullable=true)
     */
    private $check_in;
	 /**
     * @var string
     *
     * @ORM\Column(name="check_out", type="string",length=255, nullable=true)
     */
    private $check_out;
	 /**
     * @var string
     *
     * @ORM\Column(name="paper_and_ink", type="string",length=255, nullable=true)
     */
    private $paper_and_ink;
	 /**
     * @var string
     *
     * @ORM\Column(name="size", type="string",length=255, nullable=true)
     */
    private $size;
	 /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string",length=255, nullable=true)
     */
    private $artist;
	 /**
     * @var string
     *
     * @ORM\Column(name="open_time", type="string",length=255, nullable=true)
     */
    private $open_time;
	 /**
     * @var integer
     *
     * @ORM\Column(name="copies_available", type="integer", nullable=true)
     */
    private $copies_available;
	 /**
     * @var string
     *
     * @ORM\Column(name="close_time", type="string",length=255, nullable=true)
     */
    private $close_time;
	/**
     * @var string
     *
     * @ORM\Column(name="pricing_config", type="string",length=255, nullable=true, options={"comment":"From pricing_config_master table "})
     */
    private $pricing_config;
	/**
     * @var integer
     *
     * @ORM\Column(name="supplier_id", type="integer",length=255, nullable=true, options={"comment":"From user table "})
     */
    private $supplier_id;
	/**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"comment":"From user table "})
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $created_on;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated_by", type="integer", nullable=true, options={"comment":"From user table "})
     */
    private $updatedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
	/**
     * Set module
     *
     * @param string $module
     *
     * @return Products
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
	/**
     * Set SessionCapacity
     *
     * @param string $session_capacity
     *
     * @return Products
     */
    public function setSessionCapacity($session_capacity)
    {
        $this->session_capacity = $session_capacity;

        return $this;
    }

    /**
     * Get SessionCapacity
     *
     * @return string
     */
    public function getSessionCapacity()
    {
        return $this->session_capacity;
    }
	
	/**
     * Set SessionMember
     *
     * @param string $session_member
     *
     * @return Products
     */
    public function setSessionMember($session_member)
    {
        $this->session_member = $session_member;

        return $this;
    }

    /**
     * Get SessionCapacity
     *
     * @return string
     */
    public function getSessionMember()
    {
        return $this->session_member;
    }
	/**
     * Set min_people
     *
     * @param integer $min_people
     *
     * @return Products
     */
    public function setMinPeople($min_people)
    {
        $this->min_people = $min_people;

        return $this;
    }

    /**
     * Get min_people
     *
     * @return integer
     */
    public function getMinPeople()
    {
        return $this->min_people;
    }
	/**
     * Set max_people
     *
     * @param integer $max_people
     *
     * @return Products
     */
    public function setMaxPeople($max_people)
    {
        $this->max_people = $max_people;

        return $this;
    }

    /**
     * Get max_people
     *
     * @return integer
     */
    public function getMaxPeople()
    {
        return $this->max_people;
    }
	/**
     * Set under_18_allowed
     *
     * @param string $under_18_allowed
     *
     * @return Products
     */
    public function setUnder18Allowed($under_18_allowed)
    {
        $this->under_18_allowed = $under_18_allowed;

        return $this;
    }

    /**
     * Get under_18_allowed
     *
     * @return string
     */
    public function getUnder18Allowed()
    {
        return $this->under_18_allowed;
    }

	 /**
     * Set info
     *
     * @param string $info
     *
     * @return Products
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }
	/**
     * Set paper_and_ink
     *
     * @param string $paper_and_ink
     *
     * @return Products
     */
    public function setPaperAndInk($paper_and_ink)
    {
        $this->paper_and_ink = $paper_and_ink;

        return $this;
    }

    /**
     * Get paper_and_ink
     *
     * @return string
     */
    public function getPaperAndInk()
    {
        return $this->paper_and_ink;
    }
	/**
     * Set size
     *
     * @param string $size
     *
     * @return Products
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }
	/**
     * Set artist
     *
     * @param string $artist
     *
     * @return Products
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }
	/**
     * Set copies_available
     *
     * @param integer $copies_available
     *
     * @return Products
     */
    public function setCopiesAvailable($copies_available)
    {
        $this->copies_available = $copies_available;

        return $this;
    }

    /**
     * Get copies_available
     *
     * @return integer
     */
    public function getCopiesAvailable()
    {
        return $this->copies_available;
    }
	/**
     * Set open_time
     *
     * @param string $open_time
     *
     * @return Products
     */
    public function setOpenTime($open_time)
    {
        $this->open_time = $open_time;

        return $this;
    }

    /**
     * Get open_time
     *
     * @return string
     */
    public function getOpenTime()
    {
        return $this->open_time;
    }
	/**
     * Set close_time
     *
     * @param string $close_time
     *
     * @return Products
     */
    public function setCloseTime($close_time)
    {
        $this->close_time = $close_time;

        return $this;
    }

    /**
     * Get close_time
     *
     * @return string
     */
    public function getCloseTime()
    {
        return $this->close_time;
    }
	
	/**
     * Set what_to_bring
     *
     * @param string $what_to_bring
     *
     * @return Products
     */
    public function setWhatToBring($what_to_bring)
    {
        $this->what_to_bring = $what_to_bring;

        return $this;
    }

    /**
     * Get what_to_bring
     *
     * @return string
     */
    public function getWhatToBring()
    {
        return $this->what_to_bring;
    }
	
    /**
     * Set conditions
     *
     * @param string $conditions
     *
     * @return Products
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string
     */
    public function getConditions()
    {
        return $this->conditions;
    }
	/**
     * Set rules
     *
     * @param string $rules
     *
     * @return Products
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get rules
     *
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }
	/**
     * Set fineprint
     *
     * @param string $fineprint
     *
     * @return Products
     */
    public function setFinePrint($fineprint)
    {
        $this->fineprint = $fineprint;

        return $this;
    }

    /**
     * Get fineprint
     *
     * @return string
     */
    public function getFinePrint()
    {
        return $this->fineprint;
    }
	
	/**
     * Set location
     *
     * @param string $location
     *
     * @return Products
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
	
  /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Products
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
	 /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Products
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
	
   /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Products
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }
	
   /**
     * Set cost_type
     *
     * @param string $cost_type
     *
     * @return Products
     */
    public function setCostType($cost_type)
    {
        $this->cost_type = $cost_type;

        return $this;
    }

    /**
     * Get cost_type
     *
     * @return string
     */
    public function getCostType()
    {
        return $this->cost_type;
    }
	
   /**
     * Set duration_value
     *
     * @param string $duration_value
     *
     * @return Products
     */
    public function setDurationValue($duration_value)
    {
        $this->duration_value = $duration_value;

        return $this;
    }

    /**
     * Get duration_value
     *
     * @return string
     */
    public function getDurationValue()
    {
        return $this->duration_value;
    }
	
    /**
     * Set duration_type
     *
     * @param string $duration_type
     *
     * @return Products
     */
    public function setDurationType($duration_type)
    {
        $this->duration_type = $duration_type;

        return $this;
    }

    /**
     * Get duration_type
     *
     * @return string
     */
    public function getDurationType()
    {
        return $this->duration_type;
    }
	 /**
     * Set check_in
     *
     * @param string $check_in
     *
     * @return Products
     */
    public function setCheckIn($check_in)
    {
        $this->check_in = $check_in;

        return $this;
    }

    /**
     * Get check_in
     *
     * @return string
     */
    public function getCheckIn()
    {
        return $this->check_in;
    }
	 /**
     * Set check_out
     *
     * @param string $check_out
     *
     * @return Products
     */
    public function setCheckOut($check_out)
    {
        $this->check_out = $check_out;

        return $this;
    }

    /**
     * Get check_out
     *
     * @return string
     */
    public function getCheckOut()
    {
        return $this->check_out;
    }
	 /**
     * Set pricing_config
     *
     * @param string $pricing_config
     *
     * @return Products
     */
    public function setPricingConfig($pricing_config)
    {
        $this->pricing_config = $pricing_config;

        return $this;
    }

    /**
     * Get pricing_config
     *
     * @return string
     */
    public function getPricingConfig()
    {
        return $this->pricing_config;
    }
	 /**
     * Set supplier_id
     *
     * @param integer $supplier_id
     *
     * @return Products
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
     * Set status
     *
     * @param string $status
     *
     * @return Products
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Products
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created_on
     *
     * @param \DateTime $created_on
     *
     * @return Products
     */
    public function setCreatedOn($created_on)
    {
        $this->created_on = $created_on;

        return $this;
    }

    /**
     * Get created_on
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     *
     * @return Products
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     *
     * @return Products
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }
}

