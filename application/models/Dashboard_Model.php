<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/13/2017
 * Time: 3:54 PM
 */
class Dashboard_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function countPostVip($vipType){
		$query = "select count(*) as Total from product where Vip = {$vipType}";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countUser(){
		$query = "select count(*) as Total from us3r where UserGroupID != 1";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countPost(){
		$query = "select count(*) as Total from product where Status = 1 and CreatedByID is not null";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countPostDisabled(){
		$query = "select count(*) as Total from product where Status = 0 and CreatedByID is not null";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countCrawler(){
		$query = "select count(*) as Total from product where CreatedByID is null";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countSubscribe(){
		$query = "select count(*) as Total from subscrible";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function getLoginToday(){
		$today = date('Y-m-d');
		$query = "select * from us3r u where date(u.LastLogin) = '{$today}' and u.Us3rID != 1 order by u.LastLogin desc";
		$result = $this->db->query($query);
		return $result->result();
	}
	public function getRegisterToday(){
		$today = date('Y-m-d');
		$query = "select * from us3r u where date(u.CreatedDate) = '{$today}' order by u.CreatedDate desc";
		$result = $this->db->query($query);
		return $result->result();
	}
	public function getPostToday(){
		$today = date('Y-m-d');
		$query = "select p.*, u.FullName as FullName from product p inner join us3r u on p.CreatedByID = u.Us3rID where p.CreatedByID is not null and date(p.PostDate) = '{$today}' order by p.PostDate desc";
		$result = $this->db->query($query);
		return $result->result();
	}
	public function getPostPushToday(){
		$today = date('Y-m-d');
		$query = "select p.*, u.FullName as FullName from product p inner join us3r u on p.CreatedByID = u.Us3rID where p.CreatedByID is not null and date(p.ModifiedDate) = '{$today}' and p.PostDate != '{$today}' order by p.ModifiedDate desc";
		$result = $this->db->query($query);
		return $result->result();
	}
	public function updateStandardForPreviousPost(){
		$today = date('Y-m-d');
		$query = "update product set Vip = 5 where date(ModifiedDate) != '{$today}' and Vip != 5";
		$this->db->query($query);
	}
	public function countStandardForPreviousPost(){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from product where date(ModifiedDate) != '{$today}' and Vip != 5";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
}
