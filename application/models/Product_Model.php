<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 3:42 PM
 */
class Product_Model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function findById($productId) {
		$this->db->where(array("ProductID" => $productId));
		$query = $this->db->get("product");
		$product = $query->row();
		return $product;
	}

	public function findPostWithPackageToday($ipAddress, $phoneNumber, $package){
		// $this->output->enable_profiler(TRUE);
		$this->db->where(array("IpAddress" => $ipAddress, "date(PostDate)" => date('Y-m-d'), "Vip" => $package));
		$totalByIps = $this->db->count_all_results('product');
		$totalByPhone = 0;
		if($phoneNumber != null && count($phoneNumber) > 0){
			$sql = 'select count(*) as Total from product p inner join productdetail pd on p.productid = pd.productid';
			$sql .= " where p.vip = {$package} and date(p.postdate) = date(now()) and pd.contactphone = {$phoneNumber}";
			$query = $this->db->query($sql);
			$row = $query->row();
			$totalByPhone = $row->Total;
		}
		return $totalByIps > $totalByPhone ? $totalByIps : $totalByPhone;
	}

	public function findByUserId($userId, $page) {
		$this->db->order_by('ModifiedDate', 'desc');
		$this->db->where(array("CreatedByID" => $userId));

		$query = $this->db->get("product", 10, $page);
		$data['products'] = $query->result();

		$this->db->where(array("CreatedByID" => $userId));
		$total = $this->db->count_all_results('product');
		$data['total'] = $total;
		return $data;
	}

	public function findByCategoryCode($catCode, $offset=0, $limit) {
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' inner join category ct on ct.categoryid = p.categoryid';
		$sql .= ' where ct.parentid in(select ct1.categoryid from category ct1 where ct1.code = \''.$catCode.'\') or ct.code = \''.$catCode.'\' and p.status = '.ACTIVE;
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function findByHotProduct(){
		$sql = 'select p.ProductID as ProductID, p.Title as Title, p.Brief as Brief, p.Thumb as Thumb, p.PriceString as PriceString, p.Area as Area, c.CityName as CityName, d.DistrictName as DistrictName from product p';
		$sql .= ' inner join city c on p.CityID = c.CityID';
		$sql .= ' inner join district d on d.DistrictID = p.DistrictID';
		$sql .= ' where p.HotProduct = ' . ACTIVE;
		$products = $this->db->query($sql)->result();
		return $products;
	}

	public function updateViewForProductId($productId){
		$this->db->set('View', 'View + 1', false);
		$this->db->where('ProductID', $productId);
		$this->db->update('product');
	}

	public function updateViewForProductIdManual($productId, $view){
		$this->db->set('View', $view);
		$this->db->where('ProductID', $productId);
		$this->db->update('product');
	}

	public function updateVipPackageForProductId($productId, $vip){
		$this->db->set('Vip', $vip);
		$this->db->where('ProductID', $productId);
		$this->db->update('product');
	}

	public function pushPostUp($productId){
		$this->db->set('ModifiedDate', 'NOW()', false);
		$this->db->where('ProductID', $productId);
		$this->db->update('product');
	}

	public function findByIdFetchAll($productId) {
		$sql = 'select * from product p inner join productdetail pd on p.productid = pd.productid';
		$sql .= ' where p.ProductID = '. $productId;
		$query = $this->db->query($sql);
		$product = $query->row();

		// Fetch Brand
		if($product != null) {
			if ($product->BrandID != null) {
				$this->db->where("BrandID", $product->BrandID);
				$query = $this->db->get("brand");
				$product->Brand = $query->row();
			}

			// Fetch City
			if ($product->CityID != null) {
				$this->db->where("CityID", $product->CityID);
				$query = $this->db->get("city");
				$product->City = $query->row();
			}

			// Fetch District
			if ($product->DistrictID != null) {
				$this->db->where("DistrictID", $product->DistrictID);
				$query = $this->db->get("district");
				$product->District = $query->row();
			}

			// Fetch Ward
			if ($product->WardID != null) {
				$this->db->where("WardID", $product->WardID);
				$query = $this->db->get("ward");
				$product->Ward = $query->row();
			}

			// Fetch Ward
			if ($product->UnitID != null) {
				$this->db->where("UnitID", $product->UnitID);
				$query = $this->db->get("unit");
				$product->Unit = $query->row();
			}

			// Fetch Direction
			if ($product->DirectionID != null) {
				$this->db->where("DirectionID", $product->DirectionID);
				$query = $this->db->get("direction");
				$product->Direction = $query->row();
			}

			// Product Assets
			$this->db->where("ProductID", $productId);
			$query = $this->db->get("productasset");
			$product->Assets = $query->result();
		}
		return $product;
	}

	public function findByCatId($catId, $start=null, $limit=null){
		$query = $this->db->order_by('PostDate', 'desc')->get_where('product', array('CategoryID' => $catId, "Status" => 1), $limit, $start);
		$products = $query->result();

		$this->db->where('CategoryID', $catId);
		$total = $this->db->count_all_results('product');

		$data['products'] = $products;
		$data['total'] = $total;
		return $data;
	}

	public function findByCityIdFetchAddress($cityId, $offset=0, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.CityID = '.$cityId.' and p.status = 1';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product where CityID = '.$cityId.' and Status = 1';

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function findByDistrictIdFetchAddress($districtId, $offset=0, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.DistrictID = '.$districtId.' and p.status = 1';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product where DistrictID = '.$districtId.' and Status = 1';

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function findByBranchIdFetchAddress($branchId, $offset=0, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.BrandID = '.$branchId.' and p.status = 1';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product where BrandID = '.$branchId.' and Status = 1';

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function findByCatIdAndCityIdFetchAddress($catId, $cityId, $offset=0, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.CategoryID = '.$catId.' and p.CityID = '.$cityId.' and p.status = 1';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product where CategoryID = '.$catId.' and CityID = '.$cityId.' and Status = 1';

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function findByCatIdAndDistrictIdFetchAddressNotCurrent($catId, $districtId, $limit, $currentProductId){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.CategoryID = '.$catId.' and p.DistrictID = '.$districtId.' and p.status = '.ACTIVE;
		$sql .= ' and p.ProductID not in('.$currentProductId.')';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit 0, '.$limit;
		$products = $this->db->query($sql);
		return $products->result();
	}

	public function findByCatIdAndCityIdFetchAddressNotCurrent($catId, $cityId, $limit, $currentProductId){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.CategoryID = '.$catId.' and p.CityID = '.$cityId.' and p.status = '.ACTIVE;
		$sql .= ' and p.ProductID not in('.$currentProductId.')';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit 0, '.$limit;
		$products = $this->db->query($sql);
		return $products->result();
	}

	public function findByCatIdFetchAddress($catId, $offset=0, $limit){
		//$this->output->enable_profiler(TRUE);
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.categoryid = '.$catId.' and p.status = 1';
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product where CategoryID = '.$catId.' and Status = 1';

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function findByCatIdAndDistrictId($catId, $districtId, $offset=0, $limit){
		// $this->output->enable_profiler(TRUE);
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.CategoryID = '.$catId.' and p.DistrictID = '.$districtId.' and p.status = '.ACTIVE;
		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset. ','.$limit;

		$countsql = 'select count(*) as total from product p';
		$countsql .= ' inner join city c on p.cityid = c.cityid';
		$countsql .= ' inner join district d on p.districtid = d.districtid';
		$countsql .= ' where p.CategoryID = '.$catId.' and p.DistrictID = '.$districtId.' and p.status = '.ACTIVE;

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	public function updatePost($data, $assets){
		$productId = $data['productId'];

		// Get Unit
		$this->db->where("UnitID", $data['unit']);
		$query = $this->db->get("unit");
		$unit = $query->row();

		$updateData = array(
			'Title' => $data['title'],
			'Brief' => strip_tags(substr($data['description'], 0, 400).'...'),
			'Price' => $data['price'],
			'PriceString' => ($data['price'] != null && $data['price'] > 0) ? $data['price'].' '.$unit->Title : "Thỏa thuận",
			'Area' => ($data['area'] != null && $data['area'] > 0) ? $data['area'].' m²' : "KXĐ",
			'ModifiedDate' => date('Y-m-d H:i:s'),
			'CityID' => $data['city'],
			'DistrictID' => $data['district'],
			'WardID' => $data['ward'],
			'Street' => $data['street'],
			'CategoryID' => $data['categoryID'],
			'Status' => ACTIVE,
			'UnitID' => $data['unit'],
			'Address' => $data['address']
		);

		$newdatadetail = array(
			'Detail' => $data['description'],
			'Floor' => $data['floor'],
			'Room' => $data['room'],
			'Toilet' => $data['toilet'],
			'WidthSize' => $data['width'],
			'LongSize' => $data['long'],
			'Longitude' => $data['longitude'],
			'Latitude' => $data['latitude'],
			'ContactPhone' => $data['contact_phone'],
			'ContactAddress' => $data['contact_address'],
			'ContactEmail' => $data['txt_email'],
			'ContactName' => $data['contact_name'],
			'Source' => null/*,
			'Longitude' => $data['lng'],
			'Latitude' => $data['lat']*/
		);

		if($data['brand'] != null && $data['brand'] > 0){
			$updateData['BrandID'] = $data['brand'];
		}
		if($data['direction'] != null && $data['direction'] > 0){
			$newdatadetail['DirectionID'] = $data['direction'];
		}

		$this->db->where('ProductID', $productId);
		$this->db->update('product', $updateData);

		$this->saveProductAssets($productId, $assets);
		$this->saveProductDetail($productId, $newdatadetail);
		// update
		return $productId;
	}

	public function saveNewPost($data, $assets){
		// Get Unit
		$this->db->where("UnitID", $data['unit']);
		$query = $this->db->get("unit");
		$unit = $query->row();

		$dateOne = DateTime::createFromFormat("d/m/Y", $data['from_date']);
		$dateTwo = DateTime::createFromFormat("d/m/Y", $data['to_date']);

		$newdata = array(
			'code' => $data['code'],
			'Title' => $data['title'],
			'Brief' => strip_tags(substr($data['description'], 0, 400).'...'),
			'Price' => $data['price'],
			'PriceString' => ($data['price'] != null && $data['price'] > 0) ? $data['price'].' '.$unit->Title : "Thỏa thuận",
			'Area' => ($data['area'] != null && $data['area'] > 0) ? $data['area'].' m²' : "KXĐ",
			'Thumb' => $data['image'],
			'PostDate' => date('Y-m-d H:i:s'),
			'ModifiedDate' => date('Y-m-d H:i:s'),
			'FromDate' => $dateOne->format('Y-m-d H:i:s'),
			'ExpireDate' => $dateTwo->format('Y-m-d H:i:s'),//date('Y-m-d', strtotime('+1 month')),
			'CityID' => $data['city'],
			'DistrictID' => $data['district'],
			'WardID' => $data['ward'],
			'Street' => $data['street'],
			'CategoryID' => $data['categoryID'],
			'Status' => ACTIVE,
			'View' => 0,
			'CreatedByID' => $data['CreatedByID'],
			'UnitID' => $data['unit'],
			'Address' => $data['address'],
			'Vip' => $data['vip'],
			'IpAddress' => $data['ipaddress']
		);
		$newdatadetail = array(
			'Detail' => $data['description'],
			'Floor' => $data['floor'],
			'Room' => $data['room'],
			'Toilet' => $data['toilet'],
			'WidthSize' => $data['width'],
			'LongSize' => $data['long'],
			'Longitude' => $data['longitude'],
			'Latitude' => $data['latitude'],
			'ContactPhone' => $data['contact_phone'],
			'ContactAddress' => $data['contact_address'],
			'ContactEmail' => $data['txt_email'],
			'ContactName' => $data['contact_name'],
			'Source' => null/*,
			'Longitude' => $data['lng'],
			'Latitude' => $data['lat']*/
		);
		if($data['brand'] != null && $data['brand'] > 0){
			$newdata['BrandID'] = $data['brand'];
		}
		if($data['direction'] != null && $data['direction'] > 0){
			$newdatadetail['DirectionID'] = $data['direction'];
		}
		$this->db->insert('product', $newdata);
		$insert_id = $this->db->insert_id();
		$this->saveProductAssets($insert_id, $assets);
		$this->saveProductDetail($insert_id, $newdatadetail);
		return $insert_id;
	}

	public function changeStatusPost($productId, $status){
		$this->db->set('Status', $status);
		$this->db->where('ProductID', $productId);
		return $this->db->update('product');
	}

	public function updateCoordinator($productId, $longitude, $latitude){
		$this->db->set('Longitude', $longitude);
		$this->db->set('Latitude', $latitude);
		$this->db->where('ProductID', $productId);
		$this->db->update('productdetail');
	}

	public function deleteById($productId){
		$this->db->delete('productasset', array('ProductID' => $productId));
		$this->db->delete('productdetail', array('ProductID' => $productId));
		$this->db->delete('product', array('ProductID' => $productId));
	}

	private function saveProductDetail($productId, $data){
		if($productId != null && $productId > 0 && $data != null && count($data) > 0){
			// delete old items
			$this->db->delete('productdetail', array('ProductID' => $productId));
			$data['ProductID'] = $productId;
			$this->db->insert('productdetail', $data);
		}
	}

	private function saveProductAssets($productId, $assets){
		if($productId != null && $productId > 0 && $assets != null && count($assets) > 0){
			// delete old items
			$this->db->delete('productasset', array('ProductID' => $productId));

			// Save assets
			foreach ($assets as $asset){
				$newdata = array(
					'ProductID' => $productId,
					'Url' => trim($asset, "'"),
					'OrgUrl' => trim($asset, "'")
				);
				$this->db->insert('productasset', $newdata);
			}
		}
	}

	public function searchByProperties($keyword, $catId, $cityId, $districtId, $area, $price, $offset, $limit){
		//$this->output->enable_profiler(TRUE);
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.status = '.ACTIVE;
		if(isset($keyword)){
			$sql .= ' and p.Title like \'%' . $keyword .'%\'';
		}
		if(isset($catId) && $catId > -1) {
			$sql .= ' and p.CategoryID = ' . $catId;
		}
		if(isset($cityId) && $cityId > -1) {
			$sql .= ' and p.CityID = ' . $cityId;
		}
		if(isset($districtId) && $districtId > -1) {
			$sql .= ' and p.DistrictID = ' . $districtId;
		}
		if(isset($price) && $price > -1){
			$sql .= $this->buildPriceWhere($price);
		}
		if(isset($area) && $area > -1){
			$sql .= $this->buildAreaWhere($area);
		}

		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;

		$countsql = 'select count(*) as total from product p where p.Status = '.ACTIVE;
		if(isset($keyword)){
			$countsql .= ' and p.Title like \'%' . $keyword .'%\'';
		}
		if(isset($catId) && $catId > -1) {
			$countsql .= ' and p.CategoryID = ' . $catId;
		}
		if(isset($cityId) && $cityId > -1) {
			$countsql .= ' and p.CityID = ' . $cityId;
		}
		if(isset($districtId) && $districtId > -1) {
			$countsql .= ' and p.DistrictID = ' . $districtId;
		}
		if(isset($price) && $price > -1){
			$countsql .= $this->buildPriceWhere($price);
		}
		if(isset($area) && $area > -1){
			$countsql .= $this->buildAreaWhere($area);
		}

		$products = $this->db->query($sql);
		$total = $this->db->query($countsql);

		$data['products'] = $products->result();
		$total = $total->row();
		$data['total'] = $total->total;
		return $data;
	}

	private function buildPriceWhere($price){
		$where = '';

		if($price == 0){
			// thoa thuan
			$where = ' and p.Price = -1';
		}else if($price == 1){
			// < 500tr
			$where = ' and p.Price > 0 and p.Price < 500 and p.UnitID IN(select UnitID from unit where Code = "MILI")';
		}else if($price == 2){
			// < 1ty
			$where = ' and ((p.Price > 0 and p.Price < 1000 and p.UnitID IN(select UnitID from unit where Code = "MILI")) OR (p.Price <= 1 and p.UnitID IN(select UnitID from unit where Code = "BILI")))';
		}else if($price == 3){
			// 1 - 2ty
			$where = ' and p.Price >= 1 and p.Price < 2 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 4){
			// 2 - 3ty
			$where = ' and p.Price >= 2 and p.Price < 3 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 5){
			// 3 - 5ty
			$where = ' and p.Price >= 3 and p.Price < 5 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 6){
			// 5 - 7ty
			$where = ' and p.Price >= 5 and p.Price < 7 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 7){
			// 7 - 10ty
			$where = ' and p.Price >= 7 and p.Price < 10 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 8){
			// 10 - 20ty
			$where = ' and p.Price >= 10 and p.Price < 20 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}else if($price == 9){
			// > 20ty
			$where = ' and p.Price >= 20 and p.UnitID IN(select UnitID from unit where Code = "BILI")';
		}

		return $where;
	}

	private function buildAreaWhere($area){
		$where = '';

		if($area == 0){
			// CXD
			$where = ' and p.Area NOT REGEXP \'^[0-9].+$\'';
		}else if($area == 1){
			// < 30m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) > 0 and cast(p.Area AS DECIMAL(10,2)) <= 30';
		}else if($area == 2){
			// 30 - 50m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) > 30 and cast(p.Area AS DECIMAL(10,2)) < 50';
		}else if($area == 3){
			// 50 - 80m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) >= 50 and cast(p.Area AS DECIMAL(10,2)) < 80';
		}else if($area == 4){
			// 80 - 100m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) >= 80 and cast(p.Area AS DECIMAL(10,2)) < 100';
		}else if($area == 5){
			// 100 - 150m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) >= 100 and cast(p.Area AS DECIMAL(10,2)) < 150';
		}else if($area == 6){
			// 150 - 200m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) >= 150 and cast(p.Area AS DECIMAL(10,2)) < 200';
		}else if($area == 7){
			// >200m2
			$where = ' and cast(p.Area AS DECIMAL(10,2)) >= 200';
		}

		return $where;
	}

	function findAndFilter($offset=0, $limit, $st = "", $fromDate, $toDate, $createdById, $orderField, $orderDirection){
		// $this->output->enable_profiler(TRUE);
		if($fromDate){
			$ymd = DateTime::createFromFormat('d/m/Y', $fromDate)->format('Y-m-d');
			$this->db->where('date(PostDate) >=', $ymd);
		}
		if($toDate){
			$ymd = DateTime::createFromFormat('d/m/Y', $toDate)->format('Y-m-d');
			$this->db->where('date(PostDate) <=', $ymd);
		}
		if($createdById != null && $createdById > -1){
			$this->db->where('CreatedByID', $createdById);
		}
		//$query = $this->db->like('Title', $st)->limit($limit, $offset)->order_by($orderField, $orderDirection)->get('product');

		$query = $this->db->select('p.*, u.FullName')
			->from('product p')
			->join('us3r u', 'u.Us3rID = p.CreatedByID', 'left')
			->like('Title', $st)
			->limit($limit, $offset)
			->order_by($orderField, $orderDirection)
			->get();

		$result['items'] = $query->result();

		if($fromDate){
			$ymd = DateTime::createFromFormat('d/m/Y', $fromDate)->format('Y-m-d');
			$this->db->where('date(PostDate) >=', $ymd);
		}
		if($toDate){
			$ymd = DateTime::createFromFormat('d/m/Y', $toDate)->format('Y-m-d');
			$this->db->where('date(PostDate) <=', $ymd);
		}
		if($createdById != null && $createdById > -1){
			$this->db->where('CreatedByID', $createdById);
		}
		$query = $this->db->like('Title', $st)->get('product');
		$result['total'] = $query->num_rows();
		return $result;
	}

	function findByPhoneNumber($offset=0, $limit, $phoneNumber){
		$sql = "select p.*, u.FullName from product p left join us3r u on p.CreatedByID = u.Us3rID where p.productid in(select productid from productdetail where contactphone like '%{$phoneNumber}%' or contactmobile like  '%{$phoneNumber}%' )";
		$sql .= " limit ".$offset.','.$limit;
		$query = $this->db->query($sql);
		$result['items'] = $query->result();

		$countsql = "select count(*) as Total from product p where p.productid in(select productid from productdetail where contactphone like '%{$phoneNumber}%' or contactmobile like  '%{$phoneNumber}%' )";
		$querycount = $this->db->query($countsql);
		$result['total'] = $querycount->row()->Total;

		return $result;
	}

	public function findUnderOneBillion($offset, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.vip = 5 and p.status = '.ACTIVE;
		$sql .= ' and ((p.Price > 0 and p.Price < 1000 and p.UnitID IN(select UnitID from unit where Code = "MILI")) OR (p.Price <= 1 and p.UnitID IN(select UnitID from unit where Code = "BILI")))';

		$sql .= ' order by date(p.modifieddate) desc, p.vip asc';
		$sql .= ' limit '.$offset.','.$limit;
		$products = $this->db->query($sql);
		return $products->result();
	}
	public function countProductUnderOneBillion(){
		$countsql = 'select count(*) as Total from product p where p.vip = 5 and p.status = '.ACTIVE;
		$countsql .= ' and ((p.Price > 0 and p.Price < 1000 and p.UnitID IN(select UnitID from unit where Code = "MILI")) OR (p.Price <= 1 and p.UnitID IN(select UnitID from unit where Code = "BILI")))';
		$total = $this->db->query($countsql);
		$total = $total->row();
		return $total->Total;
	}

	public function findJustUpdate($offset, $limit){
		$sql = 'select p.*, c.cityname as city, d.districtname as district from product p';
		$sql .= ' inner join city c on p.cityid = c.cityid';
		$sql .= ' inner join district d on p.districtid = d.districtid';
		$sql .= ' where p.status = '.ACTIVE;

		$sql .= ' order by p.modifieddate desc';
		$sql .= ' limit '.$offset.','.$limit;

		$products = $this->db->query($sql);
		return $products->result();
	}
	public function countAllProduct(){
		$countsql = 'select count(*) as Total from product p where p.Status = '.ACTIVE;
		$total = $this->db->query($countsql);
		$total = $total->row();
		return $total->Total;
	}
}
