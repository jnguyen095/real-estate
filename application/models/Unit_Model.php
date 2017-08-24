<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/22/2017
 * Time: 2:29 PM
 */
class Unit_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findAll(){
		$query = $this->db->query("select * from unit order by DisplayOrder ASC");
		return $query->result();
	}
}
