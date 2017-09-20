<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Thông tin mua bán bất động sản, đăng tin miễn phí. Mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, chung cư.">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Tin Đất Đai | Bất Động Sản | Mua Bán Chung Cư, Nhà Đất</title>
	<link rel="icon" sizes="48x48" href="<?=base_url('/img/ico.ico')?>">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mcustome.min_v1.4.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mobile.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/home.min.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>

<div class="container">
<?php $this->load->view('/theme/header')?>

<div class="home-page row">
	<div class="home-first-row">
		<div class="col-md-3">
			<?php $this->load->view('/common/Search_filter') ?>
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
						<?php /*
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
						} */
						?>

						<?php
						$counter = 0;
						foreach ($topNews as $topNew) {
							?>
							<div class="item <?=$counter++ == 0 ? 'active' : ''?>">
								<div class="hotProduct">
									<div class="hot-title">
										<a href="<?=seo_url($topNew->Title).'-n'.$topNew->NewsID.'.html'?>"><?=$topNew->Title?></a>
									</div>
									<div class="hot-img">
										<div class="hotImg">
											<img alt="<?=$topNew->Title?>" src="<?=$topNew->Thumb?>"/>
										</div>
										<div class="clear-both"></div>
									</div>
									<div class="hot-brief"><?=$topNew->Brief?></div>
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

	<?php
	if(isset($hotBranches) && count($hotBranches) > 0) {
		?>
		<div class="home-second-row">
			<?php
			foreach ($hotBranches as $branch) {
				?>
				<div class="col-md-3">
					<div class="item">
						<div class="listing-card ">
							<a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>" class="listing-card-link listing-img-a">
								<img alt="<?=$branch->BrandName?>" src="<?=$branch->Thumb?>">
							</a>
							<div class="listing-card-info">
								<h3><a href="<?=base_url() . seo_url($branch->BrandName) . '-b' . $branch->BrandID ?>.html" title="<?=$branch->BrandName?>"
									   class="listing-card-link"><?=$branch->BrandName?></a></h3>
								<p class="listing-location"><?=$branch->Description?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<div class="clear-both"></div>
		</div>
		<div class="clear-both"></div>
		<?php
	}
	?>

	<div class="nha-dat-ban">
		<div class="col-md-9">
			<div class="block-panel">
				<div class="block-header text-left"><h1 class="h1Class">NHÀ ĐẤT BÁN</h1></div>
				<div class="block-body">
					<?php
					foreach ($nhadatban as $product){
						echo '<div class="row product-list">';
						echo '<div class="row product-title"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html">'. $product->Title .'</a> </div>';

						echo '<div class="row product-content">';
						echo '<div class="col-md-2 col-xs-5 no-padding"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html"><img style="max-width: 120px" src="'.$product->Thumb.'" alt="'.$product->Title.'"/></a></div>';
						echo '<div class="col-md-10 col-xs-7">';
						echo '<div class="row pos-relative">';

						echo '<div class="productTop">';
						echo '<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="color bold">'.$product->PriceString.'</span><span class="margin-left-10 mobile-hide">Diện tích: <span class="color bold">'.$product->Area.'</span></span><span class="margin-left-10 mobile-hide">Quận/Huyện: <span class="color bold">'.$product->district.', '.$product->city.'</span></div>';
						echo '<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right">'.date('d/m/Y', strtotime($product->PostDate)).'</div>';
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
					<div class="text-right"><a href="<?=base_url('/nha-dat-ban-c257.html')?>">Xem thêm</a></div>
				</div>
			</div>

			<div class="block-panel">
				<div class="block-header text-left"><h1 class="h1Class">NHÀ ĐẤT CHO THUÊ</h1></div>
				<div class="block-body">
					<?php
					foreach ($nhadatchothue as $product){
						echo '<div class="row product-list">';
						echo '<div class="row product-title"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html">'. $product->Title .'</a> </div>';

						echo '<div class="row product-content">';
						echo '<div class="col-md-2 col-xs-5 no-padding"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html"><img style="max-width: 120px" src="'.$product->Thumb.'" alt="'.$product->Title.'"/></a></div>';
						echo '<div class="col-md-10 col-xs-7">';
						echo '<div class="row pos-relative">';

						echo '<div class="productTop">';
						echo '<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="color bold">'.$product->PriceString.'</span><span class="margin-left-10 mobile-hide">Diện tích: <span class="color bold">'.$product->Area.'</span></span><span class="margin-left-10 mobile-hide">Quận/Huyện: <span class="color bold">'.$product->district.', '.$product->city.'</span></div>';
						echo '<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right">'.date('d/m/Y', strtotime($product->PostDate)).'</div>';
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
					<div class="text-right"><a href="<?=base_url('/nha-dat-cho-thue-c267.html')?>">Xem thêm</a></div>
				</div>
			</div>
		</div>

		<!-- begin left side -->
		<div class="col-md-3">
			<?php $this->load->view('/common/news_plot')?>
			<?php $this->load->view('/common/city-left-link')?>
			<?php $this->load->view('/common/branch-left-link')?>
		</div>
		<!-- end left side -->

	</div>
</div>

<script src="<?php echo base_url()?>js/homeland.js"></script>
<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
