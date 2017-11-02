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
	<meta name="description" content="Bất động sản mới cập nhật, nhà đất mới nhất">
	<meta name="keywords" content="mới, đăng, ký,cập, nhật, bất,động, sản">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title>Bất động sản mới cập nhật</title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url()?>"><span itemprop="name">Trang chủ</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Bất động sản mới cập nhật</span></span><meta itemprop="position" content="2" /></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="product-title"><h1 class="h1Class" itemprop="name">BẤT ĐỘNG SẢN MỚI CẬP NHẬT</h1></div>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				foreach ($products as $product){
					?>
					<div itemscope itemtype="http://schema.org/Product" class="row product-list vip<?=$product->Vip?>">
						<div class="row product-title"><a itemprop="url" href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><?=($product->Vip < 5 ? '<span class="pvip">v'.$product->Vip.'</span>' :  '')?><h3 itemprop="name"><?=$product->Title?></h3></a> </div>
						<div class="row product-content">
							<div class="col-md-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img itemprop="image" class="width100pc" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-9">
								<div class="row pos-relative">
									<div class="productTop">
										<div class="col-md-10 col-xs-12 no-padding"><span><span class="mobile-hide">Giá: </span><span class="color bold price"><?=$product->PriceString?></span><span class="margin-left-10"><span class="mobile-hide">Diện tích: </span><span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10"><span class="mobile-hide">Quận/Huyện: </span><span class="color bold mobile-block"><?=$product->district.', '.$product->city?></span></div>
										<div class="col-md-2 color bold relative-time no-padding text-right mobile-block"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
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
			<div class="row text-center">
				<?php echo $pagination ?>
			</div>
		</div>
		<div class="text-center mobile-hide">
			<a href="<?=base_url('/dang-tin.html')?>"><img src="<?=base_url('/img/bottom_banner.jpg')?>" alt="bottom banner"/></a>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/some.jpg')?>" alt="Hoa Trao Tay"/>
		<?php $this->load->view('/common/city-left-link')?>
		<?php $this->load->view('/common/news_plot')?>
		<?php $this->load->view('/common/branch-left-link')?>
		<div class="clear-both"></div>

	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
