<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flightbooking extends Application {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    private function isUriInputValid($input){
        if(!$input)
            return false;
        $airports = $this->flight->getXWingAirports();
        foreach ($airports as $key => $a) {
            if($input == $a['id'])
                return true;
        }
        return false;
    }

    private function getBookings($dept, $dest){
        $result = array();
        $deptflights = array();
        $checked_ids = array();
        $bookings = array();
        $count = 0;
        $all_flights = $this->flightsList->all();
        foreach ($all_flights as $key => $flight) {
            if($flight->departure_airport == $dept){
                if ($flight->arrival_airport == $dest) {
                    array_push($checked_ids, $flight->id);
                    array_push($result, array($flight));
                } else {
                    array_push($checked_ids, $flight->id);
                    array_push($deptflights, $flight);
                }
            }
        }
        //potential booking
        foreach ($deptflights as $key => $deptflight) {
            foreach ($all_flights as $key => $flight) {
                /* print_r($flight);
                echo !in_array($flight->id, $checked_ids);
                echo $deptflight->arrival_airport == $flight->departure_airport;
                echo $flight->arrival_airport != $deptflight->departure_airport;
                echo strtotime($deptflight->arrival_time) < strtotime($flight->arrival_time); */
                if((!in_array($flight->id, $checked_ids)) 
                    && $deptflight->arrival_airport == $flight->departure_airport 
                        && $flight->arrival_airport != $deptflight->departure_airport
                            && strtotime($deptflight->arrival_time) < strtotime($flight->arrival_time))
                        {
                            //first flight and middle flight
                            array_push($bookings, array($deptflight, $flight));
                            //array_push($checked_ids, $flight);
                        }
            }
        }
        foreach ($bookings as $key => $booking) {
            foreach ($all_flights as $key => $flight) {
            if($booking[1]->arrival_airport == $flight->departure_airport 
                && $flight->arrival_airport != $booking[1]->departure_airport
                    && strtotime($booking[1]->arrival_time) < strtotime($flight->arrival_airport->arrival_time))
                    {
                        array_push($bookings[$key], $flight);
                    }
            }
        }
        foreach ($bookings as $key => $booking) {
            if($booking[sizeof($booking)-1]->arrival_airport == $dest){
                array_push($result, $booking);
            }
        }
        return $result;
    }


	public function index()
	{
        /* 
        $airlines_count		  = $this->planesList->count();
		$flights_count		  = $this->flightsList->count();
		$base_airport		  = $this->flight->getBaseAirport();
		$destination_airports = $this->flight->getDestinationAirports();
        $airports = array(); 
        */
        $departure = $this->input->get('dept', TRUE);
        $destination = $this->input->get('dest', TRUE);
        if($this->isUriInputValid($departure) && $this->isUriInputValid($destination)){
            $this->data['bookings'] = $this->getBookings($departure, $destination);
        }
        


        //if both valid input display table
        
        $this->data['airports']                     = $this->flight->getXWingAirports();
        $this->data['flights']                      = $this->flightsList->all();
		$this->data['pagetitle']            		= 'Flight Booking';
        $this->data['pagebody'] 		 			= 'flightbooking';
        /* 

		array_push($airports, $base_airport);
		$this->data['base_airport_panel'] 			= $this->parser->parse('_airportpanel', $airports, true);
		$airports = $destination_airports;
		$this->data['destination_airports_panel']	= $this->parser->parse('_airportpanel', $airports, true);
		$this->data['airlines_count'] 	 			= $airlines_count;
		$this->data['flights_count']				= $flights_count;
 */
		//$this->data = array_merge($this->data, $destination_airports);

		$this->render();
    }
}
