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
		$airlines_count		  						= $this->planesList->count();
		$flights_count		  						= $this->flightsList->count();
		$base_airport		  						= $this->flight->getBaseAirport();
		$destination_airports 						= $this->flight->getDestinationAirports();
		$airports = array();

		$this->data['pagetitle']            		= 'Home';
		$this->data['pagebody'] 		 			= 'homepage';
		
		array_push($airports, $base_airport);
		$this->data['base_airport_panel'] 			= $this->parser->parse('_airportpanel', $airports, true);
		$airports = $destination_airports;
		$this->data['destination_airports_panel']	= $this->parser->parse('_airportpanel', $airports, true);
		$this->data['airlines_count'] 	 			= $airlines_count;
		$this->data['flights_count']				= $flights_count;


		$this->render();
	}
}
