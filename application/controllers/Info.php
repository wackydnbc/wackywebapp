<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends Application
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['pagetitle'] = 'Info';
	    $this->data['pagebody'] = 'info';
	    $this->render();
	}

	public function fleet()
	{
		header('Content-Type: application/json');
		echo json_encode($this->plane->all(), JSON_PRETTY_PRINT);
	}

	public function flights()
	{
		header('Content-Type: application/json');
		echo json_encode($this->flight->all(), JSON_PRETTY_PRINT);
	}
}
