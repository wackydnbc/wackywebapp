<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet extends Application
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Homepage for our app
	 */
	public function index()
	{
    $this->data['pagebody'] = 'Fleet';
  	$this->data['fleet'] = $this->plane->all();

  	$this->render();
	}

  /**
	 * Show just one Plane.
	 * Moved here to make it easy to implement other controllers
	 */
	public function show($key)
	{
		// this is the view we want shown
		$this->data['pagebody'] = 'plane';

		// build the list of authors, to pass on to our view
		$source = $this->plane->get($key);

		// pass on the data to present, adding the author record's fields
		$this->data = array_merge($this->data, (array) $source);

		$this->render();
	}


}
