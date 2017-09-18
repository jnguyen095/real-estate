<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/14/2017
 * Time: 8:53 AM
 */
class SampleHouse_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function searchByProperties($start=null, $limit=null){
		$query = $this->db->order_by('CreatedDate', 'desc')->get_where('samplehouse', array("Status" => ACTIVE), $limit, $start);
		$sampleHouses = $query->result();

		$this->db->where('Status', ACTIVE);
		$total = $this->db->count_all_results('samplehouse');

		$data['sampleHouses'] = $sampleHouses;
		$data['total'] = $total;
		return $data;
	}

	public function findById($sampleHouseId){
		$this->db->where(array("SampleHouseID" => $sampleHouseId));
		$query = $this->db->get("samplehouse");
		$news = $query->row();
		return $news;
	}

	public function findTopNewExceptCurrent($currentId, $limit){
		//$this->output->enable_profiler(TRUE);
		$this->db->where_not_in("SampleHouseID", $currentId);
		$query = $this->db->order_by('CreatedDate', 'desc')->get_where('samplehouse', array("Status" => ACTIVE), $limit, 0);
		$news = $query->result();
		return $news;
	}

	public function updateViewForNewsId($sampleHouseId){
		$this->db->set('View', 'View + 1', false);
		$this->db->where('SampleHouseID', $sampleHouseId);
		$this->db->update('samplehouse');
	}
}
