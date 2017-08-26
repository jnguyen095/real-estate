<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Tin Nhà Đất | Bất Động Sản | Mua Bán Chung Cư, Nhà Đất</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mcustome.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/home.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
<?php $this->load->view('/theme/header')?>

<div class="home-page row">
	<div class="home-first-row">
		<div class="col-md-3">
			<?php $this->load->view('/Search_filter') ?>
		</div>
		<div class="col-md-6">
			<div id='carousel-custom' class='carousel slide fix-height-standard orver-hidden' data-interval="5000" data-ride='carousel'>
				<div class='carousel-outer'>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<div class="item active">
							<img src="<?=base_url('/img/home-banner/nha.jpg')?>"/>
						</div>
						<div class="item">
							<img src="<?=base_url('/img/home-banner/chungcu.jpg')?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div id='carousel-custom' class='carousel slide hot-product fix-height-standard' data-interval="7000" data-ride='carousel'>
				<img class="post-star" src="<?=base_url('/img/3d-yellow-star.png')?>"/>
				<div class='carousel-outer'>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<?php
						$counter = 0;
						foreach ($hotProducts as $hotProduct) {
							?>
							<div class="item <?=$counter++ == 0 ? 'active' : ''?>">
								<div class="hotProduct">
									<div class="hot-title">
										<a href="<?=seo_url($hotProduct->Title).'-p'.$hotProduct->ProductID.'.html'?>"><?=$hotProduct->Title?></a>
									</div>
									<div class="hot-img">
										<div class="hotImg">
											<img src="<?=$hotProduct->Thumb?>"/>
										</div>
										<div class="hot-price">
											<div>Gía: <span class="color bold"><?=$hotProduct->PriceString?></span> </div>
											<div>Diện tích: <span class="color bold"><?=$hotProduct->Area?></span> </div>
											<div class="hot-area"><?=$hotProduct->DistrictName.', '.$hotProduct->CityName?></div>
										</div>
										<div class="clear-both"></div>
									</div>
									<div class="hot-brief"><?=$hotProduct->Brief?></div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear-both"></div>

	<div class="nha-dat-ban">
		<div class="col-md-9">
			<div class="block-panel">
				<div class="block-header text-left">NHÀ ĐẤT BÁN</div>
				<div class="block-body">
					<?php
					foreach ($nhadatban as $product){
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
					<div class="text-right">Xem thêm</div>
				</div>
			</div>

			<div class="block-panel">
				<div class="block-header text-left">NHÀ ĐẤT CHO THUÊ</div>
				<div class="block-body">
					<?php
					foreach ($nhadatchothue as $product){
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
					<div class="text-right">Xem thêm</div>
				</div>
			</div>
		</div>

		<!-- begin left side -->
		<div class="col-md-3">
			<?php $this->load->view('/common/city-left-link')?>
			<?php $this->load->view('/common/branch-left-link')?>
		</div>
		<!-- end left side -->

	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
