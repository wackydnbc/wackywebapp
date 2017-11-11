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

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Fleet page, using the entire fleet
	 */
	public function index()
	{
		$this->data['pagetitle'] = 'List of Planes';
		$this->data['pagebody'] = 'fleet';
		$this->data['fleet'] = $this->planeslist->all();
		$this->render();
	}

  /**
	 * Show just one Plane.
	 * Moved here to make it easy to implement other controllers
	 */
	public function show($key) {
		// this is the view we want shown
		$this->data['pagebody'] = 'plane';

		// build the list of planes, to pass on to our view
		$source = $this->plane->get( $key );

		// pass on the data to present, adding the plane's record's fields
		$this->data = array_merge( $this->data, (array) $source );

		$this->render();
	}
}
