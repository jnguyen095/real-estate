<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/15/2017
 * Time: 2:50 PM
 */
class User_Model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getUserById($id)
	{
		$sql = "select * from us3r where Us3rID = ". $id;
		$query = $this->db->query($sql);
		return $query->row();
	}

	function checkExistUserName($userName)
	{
		$this->db->where('UserName', $userName);
		$query = $this->db->get('us3r');
		return $query->num_rows();
	}

	function addNewUser($data)
	{
		$datestring = '%Y-%m-%d %h:%i:%s';
		$time = time();
		$now = mdate($datestring, $time);

		$newdata = array(
			'FullName' => $data['fullname'],
			'UserName' => $data['username'],
			'Password' => md5($data['password']),
			'Email' => $data['email'],
			'Phone' => $data['phone'],
			'Address' => $data['address'],
			'CreatedDate' => $now,
			'UpdatedDate' => $now,
			'Address' => $data['address'],
			'Status' => ACTIVE,
			'UserGroupID' => 2
		);
		$this->db->insert('us3r', $newdata);
	}
}
