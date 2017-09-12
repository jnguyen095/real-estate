<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/12/2017
 * Time: 9:31 AM
 */
class News_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function searchByProperties($start=null, $limit=null){
		$query = $this->db->order_by('CreatedDate', 'desc')->get_where('news', array("Status" => ACTIVE), $limit, $start);
		$news = $query->result();

		$this->db->where('Status', ACTIVE);
		$total = $this->db->count_all_results('news');

		$data['news'] = $news;
		$data['total'] = $total;
		return $data;
	}

	public function findById($newsId){
		$this->db->where(array("NewsId" => $newsId));
		$query = $this->db->get("news");
		$news = $query->row();
		return $news;
	}

	public function findTopNewExceptCurrent($currentId, $limit){
		//$this->output->enable_profiler(TRUE);
		$this->db->where_not_in("NewsID", $currentId);
		$query = $this->db->order_by('CreatedDate', 'desc')->get_where('news', array("Status" => ACTIVE), $limit, 0);
		$news = $query->result();
		return $news;
	}

	public function updateViewForNewsId($newsId){
		$this->db->set('View', 'View + 1', false);
		$this->db->where('NewsID', $newsId);
		$this->db->update('news');
	}

}
