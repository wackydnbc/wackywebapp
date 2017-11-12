<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * controllers/Fleet.php
 *
 * Fleet controller, inherits from default controller (core/MY_Controller.php)
 *
 *
 * @author		Connor Jang
 * ------------------------------------------------------------------------
 */

class Fleet extends Application
{
	private $planes_per_page = 10;

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Fleet page, using the entire fleet
	 */
	public function index()
	{
		$this->page(1);
	}
	
	// Show a single page of todo items
	private function show_page($planes)
	{
		$role = $this->session->userdata('userrole');
		$this->data['pagetitle'] = 'List of Planes('. $role . ')';
		
		// build the task presentation output
		$result = ''; // start with an empty array      
		foreach ($planes as $plane)
		{
			if (!empty($plane->id))
				$plane->id = $this->app->id($plane->id);
			$result .= $this->parser->parse('oneplane', (array) $plane, true);
		}
		// and then pass them on
		$this->data['display_fleet'] = $result;
		$this->data['pagebody'] = 'fleet';
		$this->render();
	}

	// Extract & handle a page of items, defaulting to the beginning
	function page($num = 1)
	{
		$records = $this->planesList->all(); // get all the tasks
		$planes = array(); // start with an empty extract

		// use a foreach loop, because the record indices may not be sequential
		$index = 0; // where are we in the tasks list
		$count = 0; // how many items have we added to the extract
		$start = ($num - 1) * $this->planes_per_page;
		foreach($records as $plane) {
			if ($index++ >= $start) {
				$planes[] = $plane;
				$count++;
			}
			if ($count >= $this->planes_per_page) break;
		}
		$this->data['pagination'] = $this->pagenav($num);
		$this->show_page($planes);
	}
	
	// Build the pagination navbar
	private function pagenav($num) {
		$lastpage = ceil($this->planesList->size() / $this->planes_per_page);
		$parms = array(
			'first' => 1,
			'previous' => (max($num-1,1)),
			'next' => min($num+1,$lastpage),
			'last' => $lastpage
		);
		return $this->parser->parse('fleetnav',$parms,true);
	}

  /**
	 * Show just one Plane.
	 * Moved here to make it easy to implement other controllers
	 */
	public function show($key) {
		// this is the view we want shown
		$this->data['pagebody'] = 'plane';

		// build the list of planes, to pass on to our view
		$source = $this->planesList->get( $key );

		// pass on the data to present, adding the plane's record's fields
		$this->data = array_merge( $this->data, (array) $source );

		$this->render();
	}
}
