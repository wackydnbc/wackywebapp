<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
	class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

class FlightsListTest extends PHPUnit_Framework_TestCase
{
	private $CI;

	public function setUp()
	{
		$this -> CI = &get_instance();
	}

	public function testFlights()
	{
		$flights = (new FlightsList()) -> all();
		foreach ($flights as $flight) {
			// test
		}
	}
}
