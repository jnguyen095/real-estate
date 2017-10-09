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
		$sql = "select u.*, ug.Code as UserGroup from us3r u inner join usergroup ug on u.UserGroupID = ug.UserGroupID where u.UserName = '" . $usr . "' and u.Password = '" . md5($pwd) . "' and u.Status = '".ACTIVE."' limit 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function get_facebooker($usr, $pwd, $fullname){
		$sql = "select * from us3r where UserName = '" . $usr . "' and Password = '" . md5($pwd) . "' and status = '".ACTIVE."' limit 1";
		$query = $this->db->query($sql);
		$result = $query->row();
		$uId = null;
		if($result == null || !isset($result->Us3rID)){
			$data = array(
				'UserGroupID' => 2,
				'UserName' => $usr,
				'Password' => md5($pwd),
				'Email' => $usr,
				'CreatedDate' => date('Y-m-d H:i:s'),
				'Status' => ACTIVE,
				'FullName' => $fullname
			);
			$this->db->insert('us3r', $data);
			$uId = $this->db->insert_id();
		}else{
			$uId = $result->Us3rID;
		}
		return $uId;
	}

	public function updateLastLogin($userId){
		$this->db->set('LastLogin', "NOW()", false);
		$this->db->where('Us3rID', $userId);
		$this->db->update('us3r');
	}


}?>
