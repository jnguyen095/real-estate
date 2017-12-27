<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="<?=$sampleHouseDetail->Title?>">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title><?=$sampleHouseDetail->Title?></title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body class="news">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb always">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url().'trang-chu.html'?>"><span itemprop="name">Trang Chủ</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url('nha-mau-dep.html')?>"><span itemprop="name">Nhà Mẫu Đẹp</span></a><meta itemprop="position" content="2" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name"><?=$sampleHouseDetail->Title?></span></span><meta itemprop="position" content="3" /></li>
</ul>

<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="search-result-panel col-md-12"><?=$sampleHouseDetail->Title?></div>
		<div class="news-date"><?=date('d/m/Y h:i', strtotime($sampleHouseDetail->CreatedDate))?></div>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php echo preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $sampleHouseDetail->Description);?>
			<div class="news-sources">
				<div class="float-left">
			<?php
				$this->load->view('/SocialShare');
				echo '</div>';
				if(isset($sampleHouseDetail->Source)){
					echo '<div class="news-source">'.$sampleHouseDetail->Source.'</div>';
				}
			?>
				<div class="clear-both"></div>
			</div>
			<div class="row news-related">
				<?php
				if(isset($topSampleHouses) && count($topSampleHouses) > 0) {
					echo '<ul class="topNews">';
					foreach ($topSampleHouses as $topSampleHouse) {
						?>
							<li><a href="<?=base_url(seo_url($topSampleHouse->Title.'-s').$topSampleHouse->SampleHouseID.'.html')?>"><?=$topSampleHouse->Title?> - <?=date('d/m/Y', strtotime($topSampleHouse->CreatedDate))?></a></li>
						<?php
					}
					echo '</ul>';
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/news_plot') ?>
		<?php $this->load->view('/common/Search_filter') ?>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>

</html>
