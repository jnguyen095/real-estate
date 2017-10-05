<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/5/2017
 * Time: 9:14 AM
 */
class StaticPage_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function updateViewForPageWithCode($code){
		$this->db->set('View', 'View + 1', false);
		$this->db->where('Code', $code);
		$this->db->update('staticpage');
	}

	public function searchByProperties($start=null, $limit){
		$query = $this->db->order_by('CreatedDate', 'desc')->get_where('staticpage', null, $limit, $start);
		$news = $query->result();

		$total = $this->db->count_all_results('staticpage');

		$data['staticpages'] = $news;
		$data['total'] = $total;
		return $data;
	}

	public function saveOrUpdate($data){
		$datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
		$now = mdate($datestring, $time);

		$newdata = array(
			'Code' => $data['code'],
			'Title' => $data['title'],
			'Description' => $data['description'],
			'ModifiedDate' => $now,
			'Status' => $data['status'],
			'View' => 0
		);

		if(isset($data['staticPageID']) && $data['staticPageID'] > 0){
			$staticPage = $this->findById($data['staticPageID']);
			$newdata['CreatedDate'] = $staticPage->CreatedDate;
			$newdata['View'] = $staticPage->View;

			$this->db->where('StaticPageID', $data['staticPageID']);
			$this->db->update('staticpage', $newdata);
			$insert_id = $data['staticPageID'];
		}else{
			$newdata['CreatedDate'] = $now;
			$this->db->insert('staticpage', $newdata);
			$insert_id = $this->db->insert_id();
		}

		return $insert_id;
	}

	public function findById($staticPageId) {
		$this->db->where(array("StaticPageID" => $staticPageId));
		$query = $this->db->get("staticpage");
		$staticPage = $query->row();
		return $staticPage;
	}

	public function findByCode($staticPageCode, $currentId=0) {
		//$this->output->enable_profiler(TRUE);
		$this->db->where(array("Code" => $staticPageCode));
		if($currentId > 0){
			$this->db->where("StaticPageID != ", $currentId, FALSE);
		}
		$query = $this->db->get("staticpage");
		$staticPage = $query->row();
		return $staticPage;
	}
}
