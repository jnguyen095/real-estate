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
		$query = "select p.*, u.FullName as FullName from product p inner join us3r u on p.CreatedByID = u.Us3rID where p.CreatedByID is not null and date(p.ModifiedDate) = '{$today}' and date(p.PostDate) != '{$today}' order by p.ModifiedDate desc";
		$result = $this->db->query($query);
		return $result->result();
	}
	public function countPostPushToday(){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from product p where p.CreatedByID is not null and date(p.ModifiedDate) = '{$today}' and date(p.PostDate) != '{$today}'";
		$result = $this->db->query($query);
		$row = $result->row();
		return $row->Total;
	}
	public function countFeedback($isToday){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from feedback fb";
		if(isset($isToday) && $isToday){
			$query .= " where date(fb.CreatedDate) = '{$today}'";
		}
		$result = $this->db->query($query);
		$row = $result->row();
		return $row->Total;
	}
	public function getPostCurrentDate($type){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from product p where date(p.ModifiedDate) = '{$today}'";
		if(isset($type) && $type == 'CRAWLER'){
			$query .= ' and p.CreatedByID is null';
		}else if(isset($type) && $type == 'CREATE'){
			$query .= " and date(p.PostDate) = '{$today}' and p.CreatedByID is not null";
		}
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function updateStandardForPreviousPost(){
		$today = date('Y-m-d');
		$query = "update product set Vip = 5 where date(ModifiedDate) != '{$today}' and Vip != 5 and CreatedByID is null";
		$this->db->query($query);
	}
	public function countStandardForPreviousPost(){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from product where date(ModifiedDate) != '{$today}' and Status = 1 and Vip != 5 and CreatedByID is null";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function countPreviousPostVip(){
		$today = date('Y-m-d');
		$query = "select count(*) as Total from product where date(ModifiedDate) != '{$today}' and Status = 1 and Vip != 5 and CreatedByID is not null";
		$total = $this->db->query($query);
		$row = $total->row();
		return $row->Total;
	}
	public function renewPreviousPostVip(){
		$today = date('Y-m-d');
		$query = "update product ModifiedDate now() where Status = 1 and Vip != 5 and CreatedByID is not null and date(ExpireDate) <= '{$today}'";
		$this->db->query($query);
	}
	function countUserByDate($limit){
		$sql = "SELECT DATE(CreatedDate) AS ForDate,";
		$sql .= "  COUNT(*) AS Total FROM us3r GROUP BY DATE(CreatedDate) ORDER BY ForDate DESC limit 0, {$limit}";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function countPostByDate($limit){
		$sql = "SELECT DATE(PostDate) AS ForDate,";
		$sql .= "  COUNT(*) AS Total FROM product WHERE CreatedByID IS NOT NULL GROUP BY DATE(PostDate) ORDER BY ForDate DESC limit 0, {$limit}";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function countProductHasNoThumb($sources){
		$this->db->where_in("Thumb", $sources);
		$num_rows = $this->db->count_all_results('product');
		return $num_rows;
	}
	public function updateProductHasNoThumb($sources, $default){
		$data = array("Thumb" => $default);
		$this->db->where_in("Thumb", $sources);
		$this->db->update("product", $data);
	}
	public function addRandomNumber2PostView($max){
		$this->output->enable_profiler(TRUE);
		$this->db->set('View', 'View + '.ROUND(1+RAND()* $max), false);
		$this->db->where("CreatedByID IS NOT NULL", NULL, false);
		$this->db->update("product");
	}
	public function retainPreviousVip($justAuthor){
		if($justAuthor){
			$today = date('Y-m-d');
			$query = "update product set ModifiedDate = now() where Status = 1 and Vip != 5 and CreatedByID is not null and date(ModifiedDate) <= '{$today}'";
			$this->db->query($query);
		}else{
			$yesterday = date('Y-m-d', strtotime("-1 days"));
			$query = "update product set ModifiedDate = now() where Status = 1 and Vip != 5 and CreatedByID is null and date(PostDate) = '{$yesterday}'";
			$this->db->query($query);
		}

	}
	public function countExpiredPost($postType){
		$today = date('Y-m-d');
		if($postType == 'Author'){
			$query = "select count(*) as Total from product where date(ExpireDate) < '{$today}' and Vip > 4 and CreatedByID is not null";
			$total = $this->db->query($query);
			$row = $total->row();
			return $row->Total;
		}else if($postType == 'Crawler'){
			$query = "select count(*) as Total from product where date(ExpireDate) < '{$today}' and CreatedByID is null";
			$total = $this->db->query($query);
			$row = $total->row();
			return $row->Total;
		}

	}
}
