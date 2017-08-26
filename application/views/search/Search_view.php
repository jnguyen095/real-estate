<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Tin Đất Đai - <?php echo $category->CatName?></title>
	<?php $this->load->view('common_header')?>
</head>

<body>
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
	 }
	?>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				foreach ($products as $product){
					echo '<div class="row product-list">';
					echo '<div class="row product-title"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html">'. $product->Title .'</a> </div>';

					echo '<div class="row product-content">';
					echo '<div class="col-md-2 col-xs-4 no-padding"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html"><img style="max-width: 120px" src="'.$product->Thumb.'"/></a></div>';
					echo '<div class="col-md-10 col-xs-8">';
					echo '<div class="row pos-relative">';

					echo '<div class="productTop">';
					echo '<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="color bold">'.$product->PriceString.'</span><span class="margin-left-10 mobile-hide">Diện tích: <span class="color bold">'.$product->Area.'</span></span><span class="margin-left-10 mobile-hide">Quận/Huyện: <span class="color bold">'.$product->district.', '.$product->city.'</span></div>';
					echo '<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right">'.relative_time($product->PostDate).'</div>';
					echo '<div class="clear-both"></div>';
					echo '</div>';

					echo '<div class="col-md-12 col-xs-12 product-brief no-padding">';
					echo '<div class="no-margin no-padding col-md-12 col-xs-12">'. $product->Brief . '</div>';
					echo '</div>';

					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			?>
			<div class="row text-center">
				<?php echo $pagination ?>
			</div>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right">
		<?php $this->load->view('/Subscrible') ?>
		<?php $this->load->view('/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
