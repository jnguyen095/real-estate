<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/31/2017
 * Time: 11:25 AM
 */

class Login_Model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//get the username & password from tbl_usrs
	function get_user($usr, $pwd)
	{
		$sql = "select * from us3r where UserName = '" . $usr . "' and Password = '" . md5($pwd) . "' and status = '".ACTIVE."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}?>
