<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Application
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * About page for our app
	 */
	public function index()
	{
	    $this->data['pagebody'] = 'about';
	    $this->data['pagetitle'] = 'About';
	    $this->render();
	}

}
