<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
	class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

class PlanesListTest extends PHPUnit_Framework_TestCase
{
	private $CI;

	public function setUp()
	{
		$this -> CI = &get_instance();

		$planesList = new PlanesList();
		$wackyModel = new WackyModel();

		$this->ourPlanes = $planesList->all();
		$this->wackyPlanes = json_decode($wackyModel->getAirplanes());
	}

	//	public function testPlaneAttributes()
	//	{
	//		$wackyIds               = array();
	//		$wackyPlaneModels       = array();
	//		$wackyManufacturers     = array();
	//		$wackySeats             = array();
	//		$wackyReach             = array();
	//		$wackyCruise            = array();
	//		$wackyTakeoff           = array();
	//		$wackyHourly            = array();
	//
	//		foreach ($this->wackyPlanes as $wackyPlane)
	//		{
	//			array_push($wackyIds, $wackyPlane->id);
	//			array_push($wackyPlaneModels, $wackyPlane->model);
	//			array_push($wackyManufacturers, $wackyPlane->manufacturer);
	//			array_push($wackySeats, $wackyPlane->seats);
	//			array_push($wackyReach, $wackyPlane->reach);
	//			array_push($wackyCruise, $wackyPlane->cruise);
	//			array_push($wackyTakeoff, $wackyPlane->takeoff);
	//			array_push($wackyHourly, $wackyPlane->hourly);
	//		}
	//
	//		foreach ($this->ourPlanes as $ourPlane)
	//		{
	//			$this->assertContains($ourPlane['key'], $wackyIds);
	//			$this->assertContains($ourPlane['model'], $wackyPlaneModels);
	//			$this->assertContains($ourPlane['manufacturer'], $wackyManufacturers);
	//			$this->assertContains($ourPlane['seats'], $wackySeats);
	//			$this->assertContains($ourPlane['reach'], $wackyReach);
	//			$this->assertContains($ourPlane['cruise'], $wackyCruise);
	//			$this->assertContains($ourPlane['takeoff'], $wackyTakeoff);
	//			$this->assertContains($ourPlane['hourly'], $wackyHourly);
	//		}
	//	}

	/**
	 * Testing for legitimate plane types.
	 */
	public function testPlaneTypes()
	{
		$wackyIds = array();

		foreach ($this->wackyPlanes as $wackyPlane)
		{
			array_push($wackyIds, $wackyPlane->id);
		}

		foreach ($this->ourPlanes as $ourPlane)
		{
			$this->assertContains($ourPlane['key'], $wackyIds);
		}
	}

	/**
	 * Testing for total capital outlay under $10million.
	 */
	public function testBudgetLimit()
	{
		$spent = 0;
		$budget = 10000;
		foreach ($this->ourPlanes as $ourPlane)
		{
			$spent = $spent + $ourPlane['price'];
		}
		$this->assertLessThanOrEqual($budget, $spent);
	}
}
