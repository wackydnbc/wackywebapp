<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fleet extends Application {

	public function index()
	{
		$this->data['pagebody'] = 'fleet';
		$this->data['pagetitle'] = 'XWing Fleet Page';
		$this->render();
	}
}
