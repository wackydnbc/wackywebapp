<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author Connor
 */
class Plane extends Entity
{
	// The data comes from httpview-source:https://wacky.jlparry.com/info/airplanes
	// expressed using long-form array notaiton in case students use PHP 5.x
	/*
	var $data = array(
			'1'	 => array('id'	            => 'x1',
		                  'manufacturer'	=> 'Cessna',
	                      'model'           => 'Citation Mustang',
	                      'price'	        => '2770',
	                      'seats'           => '4',
	                      'reach'           => '2130',
	                      'cruise'          => '630',
	                      'takeoff'         => '950',
	                      'hourly'          => '1015'),

	        '2'	 => array('id'              => 'x2',
	                      'manufacturer'	=> 'Pilatus',
	                      'model'           => 'PC-12 NG',
	                      'price'	        => '3300',
	                      'seats'           => '9',
	                      'reach'           => '4147',
	                      'cruise'          => '500',
	                      'takeoff'         => '450',
	                      'hourly'          => '727'),

	        '3'	 => array('id'	            => 'x3',
	                      'manufacturer'	=> 'Embraer',
	                      'model'           => 'Phenom 100',
	                      'price'	        => '2980',
	                      'seats'           => '4',
	                      'reach'           => '2148',
	                      'cruise'          => '704',
	                      'takeoff'         => '1036',
	                      'hourly'          => '926'),
	*/

	var $id,
		$manufacturer,
		$model,
		$price,
		$seats,
		$reach,
		$cruise,
		$takeoff,
		$hourly;

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// inject each "record" key into the record itself, for ease of presentation
		/*
		foreach ($this->data as $key => $record)
		{
			$record['key'] = $key;
			$this->data[$key] = $record;
		}
		*/
	}

	// retrieve a single plane, null if not found
	public function get($which)
	{
		return !isset($this->data[$which]) ? null : $this->data[$which];
	}

	// retrieve all of the planes (entire fleet)
	public function all()
	{
		return $this->data;
	}

	public function count()
	{
		return count($this->data);
	}

	public function generateId()
	{
		return "x" . rand();
	}

	//	id                  integer, non-negative
	//	manufacturer        string
	//	model               string
	//	price               integer, non-negative
	//	seats               integer, non-negative
	//	reach               integer, non-negative
	//	cruise              integer, non-negative
	//	takeoff             integer, non-negative
	//	hourly              integer, non-negative
	public function setId($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->id = $value;
		}
	}

	public function setManufacturer($value)
	{
		if ((is_string($value))
		    && (($value == "Cessna")
		        || ($value == "Pilatus")
		        || ($value == "Embraer")))
		{
			$this->manufacturer = $value;
		}
	}

	public function setModel($value)
	{
		if (is_string($value)
			&& (($value == "Citation Mustang")
			    || ($value == "PC-12 NG")
				|| ($value == "Phenom 100")))
		{
			$this->model = $value;
		}
	}

	public function setPrice($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->price = $value;
		}
	}

	public function setSeats($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->seats = $value;
		}
	}

	public function setReach($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->reach = $value;
		}
	}

	public function setCruise($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->cruise = $value;
		}
	}

	public function setTakeoff($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->takeoff = $value;
		}
	}

	public function setHourly($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->hourly = $value;
		}
	}
}
