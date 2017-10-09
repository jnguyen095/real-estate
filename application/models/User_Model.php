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
		$newdata = array(
			'FullName' => $data['fullname'],
			'UserName' => $data['username'],
			'Password' => md5($data['password']),
			'Email' => $data['email'],
			'Phone' => $data['phone'],
			'Address' => $data['address'],
			'CreatedDate' => date('Y-m-d H:i:s'),
			'UpdatedDate' => date('Y-m-d H:i:s'),
			'Status' => ACTIVE,
			'UserGroupID' => 2
		);
		$this->db->insert('us3r', $newdata);
	}

	function updateUser($data)
	{
		$userId = $data['UserId'];

		$newdata = array(
			'FullName' => $data['txt_fullname'],
			'Email' => $data['txt_email'],
			'Phone' => $data['txt_phone'],
			'Address' => $data['txt_address'],
			'UpdatedDate' => date('Y-m-d H:i:s')
		);
		$this->db->where('Us3rID', $userId);
		$this->db->update('us3r', $newdata);
	}

	function getAllUsers($offset=0, $limit){
		$sql = "select * from us3r u order by u.CreatedDate desc limit ".$offset.','.$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
}
