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
		$airlines_count		  = $this->planeslist->count();
		$flights_count		  = $this->flightslist->count();
		$base_airport		  = $this->flight->getBaseAirport();
		$destination_airports = $this->flight->getDestinationAirports();

		$this->data['pagetitle']            = 'Home';
		$this->data['pagebody'] 		 	= 'homepage';
		$this->data['airlines_count'] 	 	= $airlines_count;
		$this->data['base_airport_code'] 	= $base_airport["airport_code"];
		$this->data['base_location'] 	 	= $base_airport["location"];
		$this->data['flights_count']		= $flights_count;

		$this->data = array_merge($this->data, $destination_airports);

		$this->render();
	}
}
