<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller,
 * meant to be used as superclass for all our normal controllers.
 *
 * @author		JLP
 * @copyright           2010-2016, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller
{

	/**
	 * Constructor.
	 * Establish view parameters.
	 * Common helpers are specified in config/autoload.
	 */
	function __construct()
	{
		parent::__construct();

		//  Set basic view parameters to an empty set
		$this->data = array();

		// Set default page title
		$this->data['pagetitle'] = 'XWing';

		// if in development mode, show the CodeIgniter version
		$this->data['ci_version'] = (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '';
	}

	/**
	 * Render this page. View parameters have been collected in our "data" property
	 */
	function render($template = 'template')
	{
		// Build the menubar
		$this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'), true);

		// Determine the URL this page was requested as
		$this->data['origin'] = $this->uri->uri_string();

		// Establish the meat of the current page, as the "content" parameter.
		// Parse the requested content template (passed as the "pagebody" parameter) to do so.
		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

		// And then parse the page template, which will pull in and position the
		// "meat" in its middle.
		$this->parser->parse('template', $this->data);
	}

	/**
	 * Show just one actor.
	 * Moved here to make it easy to implement other controllers
	 */
	public function show($key)
	{
		// this is the view we want shown
		$this->data['pagebody'] = 'actor';

		// build the list of authors, to pass on to our view
		$source = $this->quotes->get($key);

		// pass on the data to present, adding the author record's fields
		$this->data = array_merge($this->data, (array) $source);

		$this->render();
	}

}
