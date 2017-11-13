<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends Application
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Initial info page, revealing links to show fleet and flights json data.
	 */
	public function index()
	{
		$this->data['pagetitle'] = 'Info';
	    $this->data['pagebody'] = 'info';
	    $this->render();
	}

	/**
	 * Subcontroller displaying json data from the plane model.
	 */
	public function fleet()
	{
		header('Content-Type: application/json');
		echo json_encode($this->plane->all(), JSON_PRETTY_PRINT);
	}

	/**
	 * Subcontroller displaying json data from the flight model.
	 */
	public function flights()
	{
		header('Content-Type: application/json');
		echo json_encode($this->flight->all(), JSON_PRETTY_PRINT);
	}

	public function airports()
	{
		header('Content-Type: application/json');
		echo json_encode($this->flight->getXWingAirports(), JSON_PRETTY_PRINT);
	}
}
