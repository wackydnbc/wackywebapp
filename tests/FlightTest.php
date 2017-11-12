<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
	class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

require_once '../application/models/Flight.php';

class FlightTest extends PHPUnit_Framework_TestCase
{
    private $CI;
    private $flight;

    public function setUp()
    {
        $this->CI = &get_instance();
        $this->flight = new Flight;
    }

	//	plane_id
	//	departure_time
	//	arrival_time
	//	departure_airport
	//	arrival_airport

    public function testSetPlaneId()
    {
	    $this->flight->Plane_id = 2;
	    $this->assertEquals(2, $this->flight->plane_id);

	    $this->flight->Id = "test";
	    $this->assertNotEquals("test", $this->flight->plane_id);
    }

	// correct date format, no departures before 08:00
	public function testSetDepartureTime()
	{
		// valid, after 08:00
		$this->flight->Departure_time = "2017-11-10 08:01:00";
		$this->assertEquals("2017-11-10 08:01:00", $this->flight->departure_time);

		// invalid, before 08:00
		$this->flight->Departure_time = "2017-11-10 07:59:00";
		$this->assertNotEquals("2017-11-10 07:59:00", $this->flight->departure_time);
	}

	// correct date format, no landings after 22:00
	public function testSetArrivalTime()
	{
		// valid, before 22:00
		$this->flight->Arrival_time = "2017-11-10 21:59:00";
		$this->assertEquals("2017-11-10 21:59:00", $this->flight->arrival_time);

		// invalid, after 22:00
		$this->flight->Arrival_time = "2017-11-10 22:01:00";
		$this->assertNotEquals("2017-11-10 22:01:00", $this->flight->arrival_time);
	}

	// YYJ, YVR, YBL, YPW
	public function testSetDepartureAirport()
	{
		$this->flight->Departure_airport = "YYJ";
		$this->assertEquals("YYJ", $this->flight->departure_airport);

		$this->flight->Departure_airport = "YVR";
		$this->assertEquals("YVR", $this->flight->departure_airport);

		$this->flight->Departure_airport = "YBL";
		$this->assertEquals("YBL", $this->flight->departure_airport);

		$this->flight->Departure_airport = "YPW";
		$this->assertEquals("YPW", $this->flight->departure_airport);

		$this->flight->Departure_airport = -1;
		$this->assertNotEquals(-1, $this->flight->departure_airport);

		$this->flight->Departure_airport = "";
		$this->assertNotEquals("", $this->flight->departure_airport);
	}

	// YYJ, YVR, YBL, YPW
	public function testSetArrivalAirport()
	{
		$this->flight->Arrival_airport = "YYJ";
		$this->assertEquals("YYJ", $this->flight->arrival_airport);

		$this->flight->Arrival_airport = "YVR";
		$this->assertEquals("YVR", $this->flight->arrival_airport);

		$this->flight->Arrival_airport = "YBL";
		$this->assertEquals("YBL", $this->flight->arrival_airport);

		$this->flight->Arrival_airport = "YPW";
		$this->assertEquals("YPW", $this->flight->arrival_airport);

		$this->flight->Arrival_airport = -1;
		$this->assertNotEquals(-1, $this->flight->arrival_airport);

		$this->flight->Arrival_airport = "";
		$this->assertNotEquals("", $this->flight->arrival_airport);
	}
}
