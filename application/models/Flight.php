<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data,
 * so that we don't have to worry about any database setup.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class Flight extends CI_Model
{

    var $data;

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

    function generateData(){
        $dummies = array(
            '1' => array(
                'plane_id' => 'x1',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s'), date('Y-m-d H:i:s',strtotime('+1 hour'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+9 hours')), date('Y-m-d H:i:s',strtotime('+10 hours'))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YBL'
            ),
            '2' => array(
                'plane_id' => 'x1',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 hours')), date('Y-m-d H:i:s',strtotime('+11 hours'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+19 Hours')), date('Y-m-d H:i:s',strtotime('+20 Hours'))),
                'departure_airport' => 'YBL',
                'arrival_airport'	 => 'YJJ',
            ),
            '3'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s'), date('Y-m-d H:i:s',strtotime('+1 hour'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+9 hours')), date('Y-m-d H:i:s',strtotime('+10 hours'))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YVR'),
            '4'	 => array(
                'plane_id' => 'x2',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+10 hours')), date('Y-m-d H:i:s',strtotime('+11 hours'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+19 Hours')), date('Y-m-d H:i:s',strtotime('+20 Hours'))),
                'departure_airport' => 'YVR',
                'arrival_airport' => 'YYJ'),
            '5'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s'), date('Y-m-d H:i:s',strtotime('+1 hour'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+9 hours')), date('Y-m-d H:i:s',strtotime('+10 hours'))),
                'departure_airport' => 'YYJ',
                'arrival_airport' => 'YPW'),
            '6'	 => array(
                'plane_id' => 'x3',
                'departure_time' => $this->randomDate(date('Y-m-d H:i:s'), date('Y-m-d H:i:s',strtotime('11 hours'))),
                'arrival_time' => $this->randomDate(date('Y-m-d H:i:s',strtotime('+19 Hours')), date('Y-m-d H:i:s',strtotime('+20 Hours'))),
                'departure_airport' => 'YPW',
                'arrival_airport' => 'YYJ'),
        );
        return $dummies;
    }



    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->data = $this->generateData();
        // inject each "record" key into the record itself, for ease of presentation
        foreach ($this->data as $key => $record) {
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
