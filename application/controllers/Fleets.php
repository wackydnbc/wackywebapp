<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fleets extends Application {

	public function index()
	{
		$this->data['pagebody'] = 'fleet';
		$this->data['pagetitle'] = 'XWing Fleets Page';
		$this->render();
	}
}
