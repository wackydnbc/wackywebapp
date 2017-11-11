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
	}

	public function testPlanes()
	{
		$planes = (new PlanesList()) -> all();
		foreach ($planes as $plane) {
			// test
		}
	}
}
