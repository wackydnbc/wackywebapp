<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author Connor
 */
class Plane extends CI_Model
{

	// The data comes from http://www.imdb.com/title/tt0094012/
	// expressed using long-form array notaiton in case students use PHP 5.x

	var $data = array(
		'1'	 => array('id'	 => 'x1', 'manufacturer'	 => 'Cessna', 'model' => 'Citation Mustang',
			'price'	 => '2770', 'seats' => '4', 'reach' => '2130', 'cruise' => '630', 'takeoff' => '950', 'hourly' => '1015'),

    '2'	 => array('id'	 => 'x2', 'manufacturer'	 => 'Pilatus', 'model' => 'PC-12 NG',
      'price'	 => '3300', 'seats' => '9', 'reach' => '4147', 'cruise' => '500', 'takeoff' => '450', 'hourly' => '727'),

    '3'	 => array('id'	 => 'x3', 'manufacturer'	 => 'Embraer', 'model' => 'Phenom 100',
			'price'	 => '2980', 'seats' => '4', 'reach' => '2148', 'cruise' => '704', 'takeoff' => '1036', 'hourly' => '926'),
	);

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// inject each "record" key into the record itself, for ease of presentation
		foreach ($this->data as $key => $record)
		{
			$record['key'] = $key;
			$this->data[$key] = $record;
		}
	}

	// retrieve a single quote, null if not found
	public function get($which)
	{
		return !isset($this->data[$which]) ? null : $this->data[$which];
	}

	// retrieve all of the quotes
	public function all()
	{
		return $this->data;
	}

}
