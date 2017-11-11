<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
	class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

require_once '../application/models/Plane.php';

class PlaneTest extends PHPUnit_Framework_TestCase
{
    private $CI;
    private $plane;

    public function setUp()
    {
        $this->CI = &get_instance();
        $this->plane = new Plane;
    }

	//	id
	//	manufacturer
	//	model
	//	price
	//	seats
	//	reach
	//	cruise
	//	takeoff
	//	hourly

    public function testSetId()
    {
        $this->plane->Id = 2;
        $this->assertEquals(2, $this->plane->id);

        $this->plane->Id = "test";
        $this->assertNotEquals("test", $this->plane->id);
    }

    // Cessna, Pilatus, Embraer
	public function testSetManufacturer()
	{
		$this->plane->Manufacturer = "Cessna";
		$this->assertEquals("Cessna", $this->plane->manufacturer);

		$this->plane->Manufacturer = "Pilatus";
		$this->assertEquals("Pilatus", $this->plane->manufacturer);

		$this->plane->Manufacturer = "Embraer";
		$this->assertEquals("Embraer", $this->plane->manufacturer);

		$this->plane->Manufacturer = 2;
		$this->assertNotEquals(2, $this->plane->manufacturer);

		$this->plane->Manufacturer = "";
		$this->assertNotEquals("", $this->plane->manufacturer);
	}

	// Citation Mustang, PC-12 NG, Phenom 100
	public function testSetModel()
	{
		$this->plane->Model = "Citation Mustang";
		$this->assertEquals("Citation Mustang", $this->plane->model);

		$this->plane->Model = "PC-12 NG";
		$this->assertEquals("PC-12 NG", $this->plane->model);

		$this->plane->Model = "Phenom 100";
		$this->assertEquals("Phenom 100", $this->plane->model);

		$this->plane->Model = 3;
		$this->assertNotEquals(3, $this->plane->model);

		$this->plane->Model = "";
		$this->assertNotEquals("", $this->plane->model);
	}

	// integer, non-negative
	public function testSetPrice()
	{
		$this->plane->Price = 2;
		$this->assertEquals(2, $this->plane->price);

		$this->plane->Price = -1;
		$this->assertNotEquals(-1, $this->plane->price);

		$this->plane->Price = "test";
		$this->assertNotEquals("test", $this->plane->price);
	}

	// integer, non-negative
	public function testSetSeats()
	{
		$this->plane->Seats = 2;
		$this->assertEquals(2, $this->plane->seats);

		$this->plane->Seats = -1;
		$this->assertNotEquals(-1, $this->plane->seats);

		$this->plane->Seats = "test";
		$this->assertNotEquals("test", $this->plane->seats);
	}

	// integer, non-negative
	public function testSetReach()
	{
		$this->plane->Reach = 2;
		$this->assertEquals(2, $this->plane->reach);

		$this->plane->Reach = -1;
		$this->assertNotEquals(-1, $this->plane->reach);

		$this->plane->Reach = "test";
		$this->assertNotEquals("test", $this->plane->reach);
	}

	// integer, non-negative
	public function testSetCruise()
	{
		$this->plane->Cruise = 2;
		$this->assertEquals(2, $this->plane->cruise);

		$this->plane->Cruise = -1;
		$this->assertNotEquals(-1, $this->plane->cruise);

		$this->plane->Cruise = "test";
		$this->assertNotEquals("test", $this->plane->cruise);
	}

	// integer, non-negative
	public function testSetTakeoff()
	{
		$this->plane->Takeoff = 2;
		$this->assertEquals(2, $this->plane->takeoff);

		$this->plane->Takeoff = -1;
		$this->assertNotEquals(-1, $this->plane->takeoff);

		$this->plane->Takeoff = "test";
		$this->assertNotEquals("test", $this->plane->takeoff);
	}

	// integer, non-negative
	public function testSetHourly()
	{
		$this->plane->Hourly = 2;
		$this->assertEquals(2, $this->plane->hourly);

		$this->plane->Hourly = -1;
		$this->assertNotEquals(-1, $this->plane->hourly);

		$this->plane->Hourly = "test";
		$this->assertNotEquals("test", $this->plane->hourly);
	}
}
