<!DOCTYPE html>
<html lang = "en">
<?php
	$searchBy = "";
	if(isset($category)){
		$searchBy = $category->CatName;
	} else if(isset($city)){
		$searchBy = $city->CityName;
	}else if(isset($cat_city)){
		$searchBy = $cat_city;
	}else if(isset($branch)){
		$searchBy = $branch->BrandName;
	}else{
		$searchBy = "Tìm kiếm";
	}
	?>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="audience" content="general" />
	<meta name="resource-type" content="document" />
	<meta name="abstract" content="Thông tin nhà đất Việt Nam" />
	<meta name="classification" content="Bất động sản Việt Nam" />
	<meta name="area" content="Nhà đất và bất động sản" />
	<meta name="placename" content="Việt Nam" />
	<meta name="author" content="tindatdai.com" />
	<meta name="copyright" content="©2017 tindatdai.com" />
	<meta name="owner" content="tindatdai.com" />
	<meta name="distribution" content="Global" />
	<meta name="description" content="<?=$searchBy?>">
	<meta name="keywords" content="<?=keyword_maker($searchBy)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?=$searchBy?></title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul class="breadcrumb">
	<li><a href="<?=base_url().'trang-chu.html'?>">Trang Chủ</a></li>
	<?php
	if(isset($city)) {
		?>
		<li class="active">Tìm theo thành phố <?php echo $city->CityName ?></li>
		<?php
	}else if(isset($branch)){
		?>
		<li class="active">Tìm theo dự án <?php echo $branch->BrandName ?></li>
		<?php
	}else if(isset($cat_city)){
		?>
		<li class="active"><?php echo $cat_city ?></li>
		<?php
	}else{
		?>
		<li class="active">Tìm kiếm</li>
		<?php
	}
	?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
	<?php
	 if(isset($city)){
		 echo '<div class="search-result-panel col-md-12">';
		 echo 'Nhà đất tại '.$city->CityName;
		 echo '</div>';
	 }else if(isset($branch)){
		 echo '<div class="search-result-panel col-md-12">';
		 echo 'Nhà đất dự án '.$branch->BrandName;
		 echo '</div>';
	 }else if(isset($cat_city)){
		 echo '<div class="search-result-panel col-md-12">';
		 echo $cat_city;
		 echo '</div>';
	 }else{
		 echo '<div class="search-result-panel col-md-12">';
		 echo 'Kết quả tìm kiếm';
		 echo '</div>';
	 }
	?>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				if(isset($products) && count($products) > 0){
					foreach ($products as $product) {
						?>
						<div class="row product-list vip<?=$product->Vip?>">
							<div class="row product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><?=($product->Vip < 5 ? '<span class="pvip">v'.$product->Vip.'</span>' :  '')?><h3><?=$product->Title?></h3></a> </div>
							<div class="row product-content">
								<div class="col-md-2 col-xs-5 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
								<div class="col-md-10 col-xs-7">
									<div class="row pos-relative">
										<div class="productTop">
											<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="color bold"><?=$product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?=$product->Area?></span></span><span class="margin-left-10">Quận/Huyện: <span class="color bold"><?=$product->district.', '.$product->city?></span></div>
											<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right"><?=date('d/m/Y', strtotime($product->PostDate))?></div>
											<div class="clear-both"></div>
										</div>
										<div class="col-md-12 col-xs-12 product-brief no-padding mobile-hide">
											<div class="no-margin no-padding col-md-12 col-xs-12"><?=$product->Brief?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
			?>
			<?php
			if(isset($products) && count($products) > 0) {
				?>
				<div class="row text-center">
					<?php if (isset($pagination)) echo $pagination ?>
				</div>
				<?php
			}else{
				?>
				<div class="alert alert-warning">Không tìm thấy dữ liệu phù hợp, vui lòng chọn danh mục khác.</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right">
		<?php $this->load->view('/common/branch-left') ?>
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
