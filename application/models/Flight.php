<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class Flight extends Entity
{
    var $data;
	var $plane_id,
		$departure_time,
		$arrival_time,
		$departure_airport,
        $arrival_airport;
    

    function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d H:i:s')
    {
        // Convert the supplied date to timestamp
        $fMin = strtotime($sStartDate);
        $fMax = strtotime($sEndDate);
        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);
        // Convert back to the specified date format
        return date($sFormat, $fVal);
    }

    /*
    function generateData(){
        $today = strtotime(date("Y-m-d H:i:s", mktime(0,0,0)));
        $dummies = array(
            '1' => array(
                'plane_id' => 'x1',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+8 hour', $today)), date('Y-m-d H:i:s',strtotime('+8 hour', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+9 hours +45 minutes', $today)), date('Y-m-d H:i:s',strtotime('+10 hours', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YBL'
            ),
            '2' => array(
                'plane_id' => 'x1',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 hours + 30 minutes', $today)), date('Y-m-d H:i:s',strtotime('+10 hours +30 minutes', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+12 Hours', $today)), date('Y-m-d H:i:s',strtotime('+12 Hours', $today))),
                'departure_airport' => 'YBL',
                'arrival_airport'	 => 'YYJ',
            ),
            '3' => array(
            'plane_id' => 'x1',
            'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+12 hour +30minutes', $today)), date('Y-m-d H:i:s',strtotime('+12 hour +30 minutes', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+14 hours', $today)), date('Y-m-d H:i:s',strtotime('+14 hours + 30 minutes', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YBL'
            ),
            '4' => array(
            'plane_id' => 'x1',
            'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+15 hours', $today)), date('Y-m-d H:i:s',strtotime('+15 hours', $today))),
            'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+17 Hours', $today)), date('Y-m-d H:i:s',strtotime('+17 Hours + 30 minutes', $today))),
            'departure_airport' => 'YBL',
            'arrival_airport'	 => 'YYJ',
            ),
            '5'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+8 hour', $today)), date('Y-m-d H:i:s',strtotime('+8 hour', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+8 hours + 30 minutes', $today)), date('Y-m-d H:i:s',strtotime('+9 hours', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YVR'),
            '6'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 hours', $today)), date('Y-m-d H:i:s',strtotime('+10 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 Hours 30 minutes', $today)), date('Y-m-d H:i:s',strtotime('+11 Hours', $today))),
                'departure_airport' => 'YVR',
                'arrival_airport' => 'YYJ'),
            '7'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+12 hours', $today)), date('Y-m-d H:i:s',strtotime('+12 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+12 hours + 30 minutes', $today)), date('Y-m-d H:i:s',strtotime('+13 hours', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YVR'),
            '8'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+14 hours', $today)), date('Y-m-d H:i:s',strtotime('+14 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+14 Hours 30 minutes', $today)), date('Y-m-d H:i:s',strtotime('+15 Hours', $today))),
                'departure_airport' => 'YVR',
                'arrival_airport' => 'YYJ'),
            '9'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+8 hour', $today)), date('Y-m-d H:i:s',strtotime('+8 hour', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 hours', $today)), date('Y-m-d H:i:s',strtotime('+10 hours +30 minutes', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YPW'),
            '10'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s', strtotime('+11 hours', $today)), date('Y-m-d H:i:s',strtotime('11 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+13 hours + 10 minutes', $today)), date('Y-m-d H:i:s',strtotime('+13 hours + 30 minutes', $today))),
                'departure_airport' => 'YPW',
                'arrival_airport' => 'YYJ'),
            '11'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+14 hours', $today)), date('Y-m-d H:i:s',strtotime('+14 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+16 hours + 10 minutes', $today)), date('Y-m-d H:i:s',strtotime('+16 hours +30 minutes', $today))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YPW'),
            '12'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s', strtotime('+17 hours', $today)), date('Y-m-d H:i:s',strtotime('17 hours', $today))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+19 Hours + 10 minutes', $today)), date('Y-m-d H:i:s',strtotime('+19 Hours + 30 minutes', $today))),
                'departure_airport' => 'YPW',
                'arrival_airport' => 'YYJ'),
        );
        return $dummies;
    }
    */

    // Constructor
    public function __construct()
    {
        parent::__construct();
        /*
        $this->data = $this->generateData();
        // inject each "record" key into the record itself, for ease of presentation
        foreach ($this->data as $key => $record) {
            $record['key'] = $key;
            $this->data[$key] = $record;
        }*/
    }

    // retrieve a single flight, null if not found
    public function get($which)
    {
        return !isset($this->data[$which]) ? null : $this->data[$which];
    }

    // retrieve all of the flights
    public function all()
    {
        return $this->data;
    }

    public function getBaseAirport()
    {
        $key = json_decode($this->wackyModel->getAirline(AIRLINE_XWING_ID),true)['base'];
        return json_decode($this->wackyModel->getAirport($key),true);
    }

    public function getDestinationAirports()
    {
        $dest_airport_keys = json_decode($this->wackyModel->getAirLine(AIRLINE_XWING_ID), true);
        unset($dest_airport_keys['base']);
        
        $dest_airports = array();
        foreach ($dest_airport_keys as $key => $value) {
            if($key!= 'id'){
                array_push($dest_airports,json_decode($this->wackyModel->getAirport($value),true));
            }
        }
        return $dest_airports;
    }

    public function getXWingAirports(){
        $xwing_airport_keys = json_decode($this->wackyModel->getAirline(AIRLINE_XWING_ID),true);
        $xwing_airports = array();
        foreach ($xwing_airport_keys as $key => $value) {
            if($key!= 'id'){
                array_push($xwing_airports,json_decode($this->wackyModel->getAirport($value),true));
            }
        }
        return $xwing_airports;
    }

    public function count()
    {
        return count($this->data);
    }

	//	plane_id                integer, non-negative
	//	departure_time          correct date format, no departures before 08:00
	//	arrival_time            correct date format, no landings after 22:00
	//	departure_airport       YYJ, YVR, YBL, YPW
	//	arrival_airport         YYJ, YVR, YBL, YPW
	public function setPlaneId($value)
	{
		if ((is_numeric($value)) && ($value > 0))
		{
			$this->plane_id = $value;
		}
	}

	public function setDepartureTime($value)
	{
		// check if date format is correct
		if ($value == date('Y-m-d H:i:s',strtotime($value)))
		{
			// no departures before 08:00
			if (date("H:i:s", strtotime($value)) > "08:00:00")
			{
				$this->departure_time = $value;
			}
		}
	}

	public function setArrivalTime($value)
	{
		// check if date format is correct
		if ($value == date('Y-m-d H:i:s',strtotime($value)))
		{
			// no landings after 22:00
			if (date("H:i:s", strtotime($value)) < "22:00:00")
			{
				$this->arrival_time = $value;
			}
		}
	}

	public function setDepartureAirport($value)
	{
		if (($value == "YYJ") || ($value == "YVR") || ($value == "YBL") || ($value == "YPW"))
		{
			$this->departure_airport = $value;
		}
	}

	public function setArrivalAirport($value)
	{
		if (($value == "YYJ") || ($value == "YVR") || ($value == "YBL") || ($value == "YPW"))
		{
			$this->arrival_airport = $value;
		}
	}
}
