<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 12/8/2017
 * Time: 3:09 PM
 */
class PurchaseHistory_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function findAndFilter($offset=0, $limit, $st = "", $orderField, $orderDirection){
		// $this->output->enable_profiler(TRUE);
		$query = $this->db->select('pc.*, u.FullName')
			->from('purchasehistory pc')
			->join('us3r u', 'u.Us3rID = pc.ActorID', 'left')
			->where('pc.Status', ACTIVE)
			->limit($limit, $offset)
			->order_by($orderField, $orderDirection)
			->get();

		$result['items'] = $query->result();

		$query = $this->db->get('purchasehistory');
		$result['total'] = $query->num_rows();

		return $result;
	}
}
