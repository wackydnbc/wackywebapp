<?php
/**
 * Model of the Tasks table.
 * User: vincentlee
 * Date: 2017-10-12
 * Time: 8:51 PM
 */

class PlanesList extends CSV_Model
{
    public function __construct()
    {
        parent::__construct(APPPATH . '../data/planes.csv', 'id');
    }

    public function count()
	{
		return count($this->_data);
    }
    
    public function all()
    {
        $xwing_planes = parent::all();
        $wacky_planes = json_decode($this->wackyModel->getAirplanes());

        $xwing_fleet = array();

        foreach($xwing_planes as $xwing) 
        {
            foreach($wacky_planes as $wacky)
            {
                if($xwing->airplaneId == $wacky->id)
                {
                    $xwing_plane = array();
                    $xwing_plane['id']           = $xwing->id;
                    $xwing_plane['key']          = $xwing->airplaneId;
                    $xwing_plane['model']        = $wacky->model;
                    $xwing_plane['manufacturer'] = $wacky->manufacturer;
                    $xwing_plane['price']        = $wacky->price;
	                $xwing_plane['price']        = $wacky->price;
	                $xwing_plane['seats']        = $wacky->seats;
	                $xwing_plane['reach']        = $wacky->reach;
	                $xwing_plane['cruise']       = $wacky->cruise;
	                $xwing_plane['takeoff']      = $wacky->takeoff;
	                $xwing_plane['hourly']       = $wacky->hourly;
                    array_push($xwing_fleet, $xwing_plane);
                }
            }
        }

        return $xwing_fleet;
    }

    /**
     * Returns one plane in Xwing Air's fleet
     */
    public function get($id, $key2 = null)
    {
        $plane       = parent::get($id);

        $xwing_plane = json_decode($this->wackyModel->getAirplane($plane->airplaneId));
        
        $xwing_plane->id = $id;
        $xwing_plane->airplaneId = $plane->airplaneId;

        return $xwing_plane;
    }

    /**
     * Returns one plane in Xwing Air's fleet
     */
    public function create()
    {
        $xwing_plane       = new stdClass;

        $xwing_plane->id = "";
        $xwing_plane->airplaneId = "";
        $xwing_plane->manufacturer = "";
		$xwing_plane->model = "";
        $xwing_plane->price = "";
		$xwing_plane->seats = "";
		$xwing_plane->reach = "";
		$xwing_plane->cruise = "";
		$xwing_plane->takeoff = "";
		$xwing_plane->hourly = "";

        return $xwing_plane;
    }

    /*
     * Checks if the plane to add is valid and if in budget
     */
    public function addPlaneCheck($plane) 
    {
        $plane_to_add = json_decode($this->wackyModel->getAirplane($plane->airplaneId));
        $xwing_planes = $this->all();

        // Check if plane is w/in xwing valid fleet planes
        if ($plane_to_add->id !== "mustang" && $plane_to_add->id !== "phenom100" && $plane_to_add->id !== "pc12ng"   ) { 
            return false; 
        } 
        
        $budget = 0;

        foreach($xwing_planes as $plane) {
            $budget += $plane["price"];
        }

        $budget += $plane_to_add->price;

        // Check if w/in budget
        if ($budget > 10000) {
            return false;
        }

        return true;
    }
    
	// provide form validation rules
    public function rules()
    {
        $config = array(
            ['field' => 'id', 'label' => 'Plane Id', 'rules' => 'trim|alpha_numeric|max_length[64]'],
            ['field' => 'airplaneId', 'label' => 'Plane Code', 'rules' => 'trim|alpha_numeric_spaces|max_length[64]']
        );
        return $config;
    }
}