<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="Nhà mẫu đẹp, nhà ở, chung cư">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Nhà Mẫu Đẹp</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body class="news">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url().'trang-chu.html'?>"><span itemprop="name">Trang Chủ</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Nhà Mẫu Đẹp</span></span><meta itemprop="position" content="2" /></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="search-result-panel col-md-12">Nhà Mẫu Đẹp</div>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				if(isset($sampleHouses) && count($sampleHouses) > 0){
					foreach ($sampleHouses as $sampleHouse) {
						?>
						<div class="col-sm-6 col-xs-12 product-list sample-house">
							<div class="row product-title">
								<a href="<?=base_url() . seo_url($sampleHouse->Title) . '-s' . $sampleHouse->SampleHouseID?>.html"><h3><?=$sampleHouse->Title?></h3></a>
							</div>

							<div class="row product-content">
								<div class="col-lg-7 col-sm-8 col-xs-9">
									<a href="<?=base_url() . seo_url($sampleHouse->Title) . '-s' . $sampleHouse->SampleHouseID?>.html">
										<img src="<?=middleImageReplace($sampleHouse->Thumb)?>" alt="<?=$sampleHouse->Title?>"/>
									</a>
								</div>
								<div class="col-lg-5 sample-house-brief col-sm-4 col-xs-3 no-padding-left hidden-xs">
									<div class="row pos-relative ">
										<div class="col-md-12 col-xs-12 green-color bold relative-time no-padding text-left"><?=date('d/m/Y', strtotime($sampleHouse->CreatedDate))?></div>
										<div class="hidden-sm"><?=$sampleHouse->Brief?></div>
									</div>
								</div>
								<div class="clear-both"></div>
							</div>
						</div>
					<?php
					}
				}
			?>
			<?php
			if(isset($sampleHouses) && count($sampleHouses) > 0) {
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
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/news_plot') ?>
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
