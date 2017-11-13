<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

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
	public function index()
	{
		$airlines_count		  = $this->planesList->count();
		$flights_count		  = $this->flightsList->count();
		$base_airport		  = $this->flight->getBaseAirport();
		$destination_airports = $this->flight->getDestinationAirports();

		$this->data['pagetitle']            = 'Home';
		$this->data['pagebody'] 		 	= 'homepage';
		$this->data['airlines_count'] 	 	= $airlines_count;
		$this->data['base_airport_code'] 	= $base_airport["airport_code"];
		$this->data['base_location'] 	 	= $base_airport["location"];
		$this->data['flights_count']		= $flights_count;


		$flightsList = new FlightsList();
		$planesList = new PlanesList();
		$wackyModel = new WackyModel();
		$this->ourPlanes = $planesList->all();
		$this->ourFlights = $flightsList->all();
		$this->wackyAirlines = json_decode($wackyModel->getAirlines());
		$this->wackyAirports = json_decode($wackyModel->getAirports());
		$this->wackyRegions = json_decode($wackyModel->getRegions());
		$this->wackyAirplanes = json_decode($wackyModel->getAirplanes());

		var_dump($this->ourFlights);
		//	var_dump($this->wackyAirlines);
		//	var_dump($this->wackyAirports);

		$ourPlaneIds        = array();
		$ourDepTimes        = array();
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
		var_dump($firstPlaneDep);
		var_dump($firstPlaneArr);

		for ($i = 0, $j = 1; $i < 4, $j < 4; $i++, $j++)
		{
			var_dump($this->convertDateToHoursInt($firstPlaneDep[$j]));
			var_dump($this->convertDateToHoursInt(date("Y-m-d H:i:s", strtotime($firstPlaneArr[$i] . " +30 minutes"))));
		}

		$this->data = array_merge($this->data, $destination_airports);

		$this->render();
	}

	public function convertDateToHoursInt($date)
	{
		$dateCopy = substr($date, 11, -3); // remove date and ms
		$dateCopy = str_replace(':', '', $dateCopy); // remove :
		$dateCopy = intval($dateCopy); // convert to an int to compare
		return $dateCopy;
	}
}
