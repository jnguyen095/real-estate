<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/12/2017
 * Time: 10:48 PM
 */
class Subscrible_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function findByEmail($email){
		$this->db->where("Email", $email);
		$query = $this->db->get("subscrible");
		return $query->num_rows();
	}

	public function insert($data) {
		if ($this->db->insert("subscrible", $data)) {
			return true;
		}
	}
}
