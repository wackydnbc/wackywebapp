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
			// If admin/owner, link to edit page, show page for guest users
			if ($role == ROLE_OWNER)
				$result .= $this->parser->parse('oneplanex', (array) $plane, true);
			else
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
		// If user is admin/owner, then include 'add plane' button
		$role = $this->session->userdata('userrole');
			if ($role == ROLE_OWNER) 
				$this->data['pagination'] .= $this->parser->parse('planeaddbutton',[], true);
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


	// Initiate adding a new plane
	public function add()
	{
		$plane = $this->planesList->create();
		$this->session->set_userdata('plane', $plane);
		$this->showAdd();
	}
	// initiate editing of a task
	public function edit($id = null)
	{
		if ($id == null)
			redirect('/fleet');
		$plane = $this->planesList->get($id);
		$this->session->set_userdata('plane', $plane);
		$this->showit();
	}

	// Render the current plane
	// showit() called when admin/owner clicks on plane id in fleet page
	public function showit($key = null)
	{
		$this->load->helper('form');

		if ($key != null) {
			$plane = $this->planesList->get( $key );
		} else {
			$plane = $this->planesList->create();
		}

		$this->session->set_userdata('plane', $plane);

		// if no errors, pass an empty message
		if ( ! isset($this->data['error']))
			$this->data['error'] = '';
		
		
		$fields = array(
			'fid'      => form_label('Plane Id') . form_input('id', $plane->id),
			'fplanecode'  => form_label('Plane Code') . form_input('airplaneId', $plane->airplaneId),
			'fmodel'  => form_label('Plane Model') . form_input('model', $plane->model),
			'fmanufacturer'  => form_label('Plane Manufacturer') . form_input('manufacturer', $plane->manufacturer),
			'fprice'  => form_label('Price') . form_input('price', $plane->price),
			'fseats'  => form_label('Seats') . form_input('seats', $plane->seats),
			'freach'  => form_label('Reach') . form_input('model', $plane->model),
			'fcruise'  => form_label('Avg Cruising Speed') . form_input('cruise', $plane->cruise),
			'ftakeoff'  => form_label('Takeoff Distance') . form_input('takeoff', $plane->takeoff),
			'fhourly'  => form_label('Hourly Cost') . form_input('hourly', $plane->hourly),
			'zsubmit'    => form_submit('submit', 'Update the Plane'),
		);

		// pass on the data to present, adding the plane's record's fields
		$this->data = array_merge( $this->data, (array) $fields );
		$this->data['pagebody'] = 'planeedit';
		$this->render();
	}

	public function showAdd() 
	{
		$this->load->helper('form');

		$plane = $this->planesList->create();


		$this->session->set_userdata('plane', $plane);
		
		// if no errors, pass an empty message
		if ( ! isset($this->data['error']))
			$this->data['error'] = '';

		$fields = array(
			'fplanecode'  => form_label('Plane Code to Add: ') . form_input('airplaneId', $plane->airplaneId),
			'zsubmit'    => form_submit('submit', 'Add the Plane')
		);

		// pass on the data to present, adding the plane's record's fields
		$this->data = array_merge( $this->data, (array) $fields );
		$this->data['pagebody'] = 'planeadd';
		$this->render();
	}

	// handle form submission
	public function submit()
	{
		// setup for validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->planesList->rules());

		// retrieve & update data transfer buffer
		$plane_orig = (array) $this->session->userdata('plane');
		$plane_orig = array_merge($plane_orig, $this->input->post());
		$plane_orig = (object) $plane_orig;  // convert back to object

		// From the post data only retrieve the id and airplane id
		$plane 			   = new stdClass;
		$plane->id 		   = $plane_orig->id;
		$plane->airplaneId = $plane_orig->airplaneId;

		$this->session->set_userdata('plane', (object) $plane);

		// validate away
		if ($this->form_validation->run())
		{
			if (empty($plane->id))
			{
				if ($this->planesList->addPlaneCheck($plane)) 
				{
					$plane->id = $this->plane->generateId();
					$this->planesList->add($plane);
					$this->alert('Plane ' . $plane->id . ' added', 'success');
				}
				else 
				{
					$this->alert('<strong>Cannot add plane! We\'re either out of budget or not within xwing\'s fleet<strong><br>' . 'error adding plane', 'danger');
				}
			} 
			else
			{
				$this->planesList->update($plane);
				$this->alert('Plane ' . $plane->id . ' updated', 'success');
			}
		} 
		else
		{
			$this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
		}
		$this->index();
	}

	// build a suitable error mesage
	private function alert($message) {
		$this->load->helper('html');        
		$this->data['error'] = heading($message,3);
	}

	// Forget about this edit
	public function cancel() {
		$this->session->unset_userdata('plane');
		$this->index();
	}

	// Delete this item altogether
	public function delete()
	{
		$plane = $this->session->userdata('plane');

		if ($plane->id != null && !empty($plane->id)) {
			$this->planesList->delete($plane->id);
			$this->session->unset_userdata('plane');
			$this->index();
		}
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
