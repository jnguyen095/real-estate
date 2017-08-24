<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/22/2017
 * Time: 2:50 PM
 */
class Brand_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findAll(){
		$query = $this->db->query("select * from brand order by BrandName ASC");
		return $query->result();
	}
}
