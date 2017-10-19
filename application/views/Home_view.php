<!DOCTYPE html>
<html lang = "en">

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
	<meta name="description" content="Thông tin mua bán bất động sản, đăng tin miễn phí. Mua bán nhà đất, cho thuê nhà đất, văn phòng, căn hộ, biệt thự, chung cư, tin tức bất động sản, thiết kế đẹp, nhà mẫu, tin thị trường">
	<meta name="keywords" content="Bất, động, sản, bán, nhà, chung, cư, mua, đất, real, estate">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Tin Đất Đai | Bất Động Sản | Mua Bán Chung Cư, Nhà Đất</title>
	<link rel="icon" sizes="48x48" href="<?=base_url('/img/ico.ico')?>">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mcustome.min_v3.0.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mobile.min_v1.8.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/home.min_v1.4.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>

<?php $this->load->view('/theme/header')?>
<div class="container">


<div class="home-page row">
	<div class="home-first-row">
		<div class="col-md-3">
			<?php $this->load->view('/common/Search_filter') ?>
		</div>
		<div class="col-md-6 mobile-hide">
			<div class="fix-height">
				<div class="news-view">
					<div class="col-md-5 col-sm-12 no-padding-left">
						<a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>">
							<img class="width100pc" alt="<?=$topNews[0]->Title?>" src="<?=str_replace("132x100", "210x160", $topNews[0]->Thumb)?>"/>
						</a>
					</div>
					<div class="col-md-7 col-sm-12 no-padding-right">
						<h2><a href="<?=seo_url($topNews[0]->Title).'-n'.$topNews[0]->NewsID.'.html'?>"><?=$topNews[0]->Title?></a></h2>
						<div class="news-description"><?=$topNews[0]->Brief?></div>
						<div class="news-date text-right"><?=date('d/m/Y', strtotime($topNews[0]->CreatedDate))?></div>
					</div>
					<div class="clear-both"></div>
				</div>
				<div class="news-links mCustomScrollbar">
					<ul class="">
						<?php
						$index = 1;
						foreach ($topNews as $topNew) {
							if ($index > 1) {
								?>
								<li>
									<a href="<?= seo_url($topNew->Title) . '-n' . $topNew->NewsID . '.html' ?>"><?= $topNew->Title ?></a>
								</li>
								<?php
							}
							$index++;
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-3 mobile-hide">
			<div id='carousel-custom' class='carousel slide hot-product fix-height-standard' data-interval="7000" data-ride='carousel'>
				<img class="post-star" src="<?=base_url('/img/3d-yellow-star.png')?>"/>
				<div class='carousel-outer'>
					<!-- Wrapper for slides -->
					<div class='carousel-inner'>
						<div class="item active">
							<img src="<?=base_url('/img/home-banner/nha0.jpg')?>" alt="Nhà ở"/>
						</div>
						<div class="item">
							<img src="<?=base_url('/img/home-banner/canho.jpg')?>" alt="Căn hộ"/>
						</div>
						<div class="item">
							<img src="<?=base_url('/img/home-banner/bietthu.jpg')?>" alt="Biệt thự"/>
						</div>
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

			<div class="home-group">
				<div class="block-header text-left"><a href="<?=base_url('/nha-dat-ban-c257.html')?>"><h2 class="h2Class">NHÀ ĐẤT BÁN</h2></a></div>
				<?php
				foreach ($nhadatban as $product){
					?>
					<div itemscope itemtype="http://schema.org/Product" class="row product-list">
						<div class="row product-title"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><h3 itemprop="name"><?=$product->Title?></h3></a> </div>
						<div class="row product-content">
							<div class="col-md-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-9">
								<div class="row pos-relative">
									<div class="productTop">
										<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="price bold"><?=$product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10">Quận/Huyện: <span class="color bold"><?=$product->district.', '.$product->city?></span></div>
										<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
										<div class="clear-both"></div>
									</div>

									<div class="col-md-12 col-xs-12 product-brief no-padding mobile-hide">
										<div class="no-margin no-padding col-md-12 col-xs-12" itemprop="description"><?=$product->Brief?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				<div class="text-right"><a href="<?=base_url('/nha-dat-ban-c257.html')?>">&#187; Xem thêm</a></div>
			</div>

			<div class="home-group">
				<div class="block-header text-left"><a href="<?=base_url('/nha-dat-cho-thue-c267.html')?>"><h2 class="h2Class">NHÀ ĐẤT CHO THUÊ</h2></a></div>
				<?php
				foreach ($nhadatchothue as $product){
					?>
					<div itemscope itemtype="http://schema.org/Product" class="row product-list">
						<div class="row product-title"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><h3 itemprop="name"><?=$product->Title?></h3></a> </div>
						<div class="row product-content">
							<div class="col-md-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-9">
								<div class="row pos-relative">
									<div class="productTop">
										<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="price bold"><?=$product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10">Quận/Huyện: <span class="color bold"><?=$product->district.', '.$product->city?></span></div>
										<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
										<div class="clear-both"></div>
									</div>
									<div class="col-md-12 col-xs-12 product-brief no-padding mobile-hide">
										<div class="no-margin no-padding col-md-12 col-xs-12" itemprop="description"><?=$product->Brief?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
				<div class="text-right"><a href="<?=base_url('/nha-dat-cho-thue-c267.html')?>">&#187; Xem thêm</a></div>
			</div>

			<div class="row home-group">
				<div class="col-md-6 col-xs-12">
					<div class="block-header text-left"><h2 class="h2Class">NHÀ ĐẤT DƯỚI 1 TỶ</h2></div>
					<?php
					foreach ($underOneBillion as $product){
						?>
						<div itemscope itemtype="http://schema.org/Product" class="briefHome row">
							<div class="col-md-2 col-xs-2 no-padding"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="imgBrief" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-10 no-padding-right">
								<div class="product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=limit_text($product->Title, 25)?></h3></a> </div>
								<div class="product-info">
									<div><span class="color"><?=$product->district.', '.$product->city?></span> <span class="price"><?=$product->PriceString?></span></div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="block-header text-left"><h2 class="h2Class">MỚI CẬP NHẬT</h2></div>
					<?php
					foreach ($justUpdates as $product){
						?>
						<div itemscope itemtype="http://schema.org/Product" class="briefHome row">
							<div class="col-md-2 col-xs-2 no-padding"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="imgBrief" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-10 no-padding-right">
								<div class="product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html" title="<?=$product->Title?>"><h3 itemprop="name"><?=limit_text($product->Title, 25)?></h3></a> </div>
								<div class="product-info">
									<div><span class="color"><?=$product->district.', '.$product->city?></span> <span class="price"><?=$product->PriceString?></span></div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>

			<div class="text-center mobile-hide">
				<a href="<?=base_url('/dang-tin.html')?>"><img src="<?=base_url('/img/bottom_banner.jpg')?>" alt="bottom banner"/></a>
			</div>
		</div>

		<!-- begin left side -->
		<div class="col-md-3">
			<?php $this->load->view('/common/sample_house_plot')?>
			<?php $this->load->view('/common/city-left-link')?>
			<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/hoatraotay.jpg')?>" alt="Hoa Trao Tay"/>
			<?php $this->load->view('/common/branch-left-link')?>
		</div>
		<!-- end left side -->

	</div>
</div>

<script src="<?php echo base_url()?>js/homeland.min_v1.2.js"></script>
<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
