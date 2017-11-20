<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/19/2017
 * Time: 10:39 PM
 */
class FeedBack_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function addNewFeedBack($data)
	{
		$newdata = array(
			'FullName' => $data['fullName'],
			'PhoneNumber' => $data['phoneNumber'],
			'Email' => $data['email'],
			'Content' => $data['content'],
			'IpAddress' => $data['ipAddress'],
			'CreatedDate' => date('Y-m-d H:i:s')
		);
		$this->db->insert('feedback', $newdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function findAndFilter($offset=0, $limit, $st = "", $orderField, $orderDirection){
		// $this->output->enable_profiler(TRUE);
		$query = $this->db->select('fb.*')
			->from('feedback fb')
			->or_like('fb.FullName', $st)
			->or_like('fb.Email', $st)
			->or_like('fb.PhoneNumber', $st)
			->limit($limit, $offset)
			->order_by($orderField, $orderDirection)
			->get();

		$result['items'] = $query->result();

		$query = $this->db->or_like('FullName', $st)->or_like('Email', $st)->or_like('PhoneNumber', $st)->get('feedback');
		$result['total'] = $query->num_rows();

		return $result;
	}

	function deleteById($feedBackId){
		$this->db->delete('feedback', array('FeedBackID' => $feedBackId));
	}

	public function findById($feedBackID) {
		$this->db->where(array("FeedBackID" => $feedBackID));
		$query = $this->db->get("feedback");
		$product = $query->row();
		return $product;
	}

}
