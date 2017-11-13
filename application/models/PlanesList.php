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
	                $xwing_plane['cruise']        = $wacky->cruise;
	                $xwing_plane['takeoff']        = $wacky->takeoff;
	                $xwing_plane['hourly']        = $wacky->hourly;
                    array_push($xwing_fleet, $xwing_plane);
                }
            }
        }

        return $xwing_fleet;
    }

    /**
     * Returns one plane in Lightning Air's fleet
     */
    public function get($id, $key2 = null)
    {
        $plane       = parent::get($id);

        $xwing_plane = json_decode($this->wackyModel->getAirplane($plane->airplaneId));
        
        $xwing_plane->id = $id;

        return $xwing_plane;
    }
}