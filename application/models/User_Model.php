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
			'UserGroupID' => 2,
			'AvailableMoney' => 0,
			'DepositedMoney' => 0,
			'SpentMoney' => 0
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

	function getAllUsers($offset=0, $limit, $st = "", $orderField, $orderDirection){
		$query = $this->db->select('u.*, count(p.ProductID) as Total')
			->from('us3r u')
			->join('product p', 'u.Us3rID = p.CreatedByID', 'left')
			->or_like('u.FullName', $st)
			->or_like('u.Email', $st)
			->or_like('u.Phone', $st)
			->limit($limit, $offset)
			->group_by('u.Us3rID')
			->order_by($orderField, $orderDirection)
			->get();

		// $query = $this->db->or_like('FullName', $st)->or_like('Email', $st)->or_like('Phone', $st)->limit($limit, $offset)->order_by($orderField, $orderDirection)->get('us3r');
		$result['items'] = $query->result();
		$query = $this->db->or_like('FullName', $st)->or_like('Email', $st)->or_like('Phone', $st)->get('us3r');
		$result['total'] = $query->num_rows();
		return $result;
	}
}
