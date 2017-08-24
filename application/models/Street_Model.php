<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/17/2017
 * Time: 1:08 PM
 */
class Street_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findByName($keyword){
		$query = $this->db->query("select distinct Street from product where Street IS NOT NULL and Street like '%".$keyword."%' limit 10");
		return $query->result();
	}
}
