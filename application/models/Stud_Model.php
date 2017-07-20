<?php
class Stud_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

		public function insert($data) {
			if ($this->db->insert("stud", $data)) {
				return true;
			}
		}

	public function delete($roll_no) {
		if ($this->db->delete("stud", "roll_no = ".$roll_no)) {
			return true;
		}
	}

	public function update($data,$old_roll_no) {
		$this->db->set($data);
		$this->db->where("roll_no", $old_roll_no);
		$this->db->update("stud", $data);
	}
}
?>
