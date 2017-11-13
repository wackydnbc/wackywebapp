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

		$flightsList = new FlightsList();
		$wackyModel = new WackyModel();

		$this->ourFlights = $flightsList->all();
		$this->wackyAirlines = json_decode($wackyModel->getAirlines());
		$this->wackyAirports = json_decode($wackyModel->getAirports());
		$this->wackyRegions = json_decode($wackyModel->getRegions());
	}

	/**
	 * Converts date ('YY-MM-DD h:m:s') to integer (hhmm) for comparing purposes.
	 */
	public function convertDateToHoursInt($date)
	{
		$dateCopy = substr($date, 11, -3); // remove date and ms
		$dateCopy = str_replace(':', '', $dateCopy); // remove :
		$dateCopy = intval($dateCopy); // convert to an int to compare
		return $dateCopy;
	}

	/**
	 * Testing for legitimate departure airports.
	 */
	public function testDepartureAirports()
	{
		$ourDepAirports = array();
		foreach ($this->ourFlights as $ourFlight)
		{
			array_push($ourDepAirports, $ourFlight->departure_airport);
		}
		// check if all our departure airports are valid from server
		foreach ($this->wackyAirlines as $wackyAirline)
		{
			foreach ($ourDepAirports as $ourDepAirport)
			{
				if ($wackyAirline->id == 'xwing') // only check against our bird
				{
					// find our departure airport within the server's base, dest1, dest2, dest3
					// if not found - test failed
					$this->assertContains($ourDepAirport, [$wackyAirline->base,
															$wackyAirline->dest1,
															$wackyAirline->dest2,
															$wackyAirline->dest3]);
				}
			}
		}
	}

	/**
	 * Testing for legitimate arrival airports.
	 */
	public function testArrivalAirports()
	{
		$ourArrAirports = array();
		foreach ($this->ourFlights as $ourFlight)
		{
			array_push($ourArrAirports, $ourFlight->arrival_airport);
		}
		// check if all our arrival airports are valid from server
		foreach ($this->wackyAirlines as $wackyAirline)
		{
			foreach ($ourArrAirports as $ourArrAirport)
			{
				if ($wackyAirline->id == 'xwing') // only check against our bird
				{
					// find our arrival airport within the server's base, dest1, dest2, dest3
					// if not found - test failed
					$this->assertContains($ourArrAirport, [$wackyAirline->base,
															$wackyAirline->dest1,
															$wackyAirline->dest2,
															$wackyAirline->dest3]);
				}
			}
		}
	}

	/**
	 * Testing for no departures before 08:00.
	 */
	public function testDepartureTimeRules()
	{
		$ourDepTimes = array();
		foreach ($this->ourFlights as $ourFlight)
		{
			array_push($ourDepTimes, $ourFlight->departure_time);
		}
		foreach ($ourDepTimes as $ourDepTime)
		{
			$this->assertGreaterThanOrEqual(800, $this->convertDateToHoursInt($ourDepTime));
		}
	}

	/**
	 * Testing for no landings after 22:00.
	 */
	public function testArrivalTimeRules()
	{
		$ourArrTimes = array();
		foreach ($this->ourFlights as $ourFlight)
		{
			array_push($ourArrTimes, $ourFlight->arrival_time);
		}
		foreach ($ourArrTimes as $ourArrTime)
		{
			$this->assertLessThanOrEqual(2200, $this->convertDateToHoursInt($ourArrTime));
		}
	}

	/**
	 * Testing for the half an hour non-booking buffer zone between connecting flights.
	 * Assuming all bookings (departures/arrivals) are ordered.
	 */
	public function testTimeBetweenFlights()
	{
		$firstPlaneDep      = array(); // x1
		$firstPlaneArr      = array();
		$secondPlaneDep     = array(); // x2
		$secondPlaneArr     = array();
		$thirdPlaneDep      = array(); // x3
		$thirdPlaneArr      = array();

		foreach ($this->ourFlights as $ourFlight)
		{
			if ($ourFlight->plane_id == 'x1')
			{
				array_push($firstPlaneDep, $ourFlight->departure_time);
				array_push($firstPlaneArr, $ourFlight->arrival_time);
			} else if ($ourFlight->plane_id == 'x2')
			{
				array_push($secondPlaneDep, $ourFlight->departure_time);
				array_push($secondPlaneArr, $ourFlight->arrival_time);
			} else if ($ourFlight->plane_id == 'x3')
			{
				array_push($thirdPlaneDep, $ourFlight->departure_time);
				array_push($thirdPlaneArr, $ourFlight->arrival_time);
			}
		}

		// here I'm checking if the plane's next dep time is at least 30 minutes after its previous arr time
		for ($i = 0, $j = 1; $i < 4, $j < 4; $i++, $j++)
		{
			$this->assertGreaterThanOrEqual(
				$this->convertDateToHoursInt(
					date("Y-m-d H:i:s", strtotime($firstPlaneArr[$i] . " +30 minutes"))
				),
				$this->convertDateToHoursInt($firstPlaneDep[$j])
			);
			$this->assertGreaterThanOrEqual(
				$this->convertDateToHoursInt(
					date("Y-m-d H:i:s", strtotime($secondPlaneArr[$i] . " +30 minutes"))
				),
				$this->convertDateToHoursInt($secondPlaneDep[$j])
			);
			$this->assertGreaterThanOrEqual(
				$this->convertDateToHoursInt(
					date("Y-m-d H:i:s", strtotime($thirdPlaneArr[$i] . " +30 minutes"))
				),
				$this->convertDateToHoursInt($thirdPlaneDep[$j])
			);
		}
	}
}
