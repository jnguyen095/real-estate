<!DOCTYPE html>
<html lang = "en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="audience" content="general" />
	<meta name="resource-type" content="document" />
	<meta name="abstract" content="Gọi vốn, hợp tác bất động sản, startup, khởi nghiệp, hợp tác kinh doanh" />
	<meta name="classification" content="Tìm đối tác, hợp tác kinh doanh, khởi nghiệp, startup, góp vốn" />
	<meta name="area" content="Hợp tác bất động sản" />
	<meta name="placename" content="Việt Nam" />
	<meta name="author" content="tindatdai.com" />
	<meta name="copyright" content="©2017 tindatdai.com" />
	<meta name="owner" content="tindatdai.com" />
	<meta name="distribution" content="Global" />
	<meta name="description" content="<?=$cooperate->Title?>">
	<meta name="keywords" content="<?=keyword_maker($cooperate->Title)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?php echo $cooperate->Title?></title>
	<?php $this->load->view('common_header')?>
	<link rel="stylesheet" href="<?=base_url('/css/jquery.mCustomScrollbar.min.css')?>" />
	<link rel="stylesheet" href="<?=base_url('/css/carousel-custom.css')?>" />
	<script src="<?=base_url('/js/jquery.mCustomScrollbar.min.js')?>"></script>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<div id="fb-root"></div>
<?php $this->load->view('/FacebookID'); ?>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
<?php $this->load->view('/theme/header')?>

<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb always">
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo base_url('hop-tac.html')?>"><span itemprop="name">Hợp Tác</span></a><meta itemprop="position" content="1" /></li>
	<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active mobile-hide"><span itemprop="item"><span itemprop="name"><?=$cooperate->Title?></span></span><meta itemprop="position" content="2" /></li>
</ul>
<div class="row no-margin">
	<div itemscope itemtype="http://schema.org/Product" class="col-md-9 no-margin no-padding product-detail">
		<div class="product-title"><h1 class="h1Class" itemprop="name"><?php echo $cooperate->Title?></h1></div>

		<div class="row">
			<div class="col-md-12"><span class="price-detail price"><?php echo $cooperate->PriceString?></span>	</div>
			<div class="col-md-3 area-detail">Diện tích: <?=is_numeric($cooperate->Area) ? $cooperate->Area.' m²' : $cooperate->Area?></div>
			<div class="col-md-9 text-right addr-detail">
				<span class="glyphicon glyphicon-map-marker"></span><span class="addr-detail">
				<?php
				if(isset($cooperate->Street)){
					echo $cooperate->Street;
					echo ' - ';
				}
				if(isset($cooperate->Ward)){
					echo $cooperate->Ward->WardName;
					echo ' - ';
				}
				if(isset($cooperate->District)){
					echo $cooperate->District->DistrictName;
				}
				if(isset($cooperate->City)){
					echo ' - ';
					echo $cooperate->City->CityName;
				}
				?>
				</span>
			</div>
		</div>


		<div class="h2title">Chi Tiết</div>

		<div id="prDetail" class="product-detail content" itemprop="description">
			<?php echo $cooperate->Detail?>
		</div>

		<div class="row">

			<div class="col-md-6">
				<table class="table tableBorder">
					<tr class="tbHeader">
						<td colspan="2">Liên Hệ</td>
					</tr>
					<tr>
						<td class="width100">Liên hệ</td>
						<td><?=$cooperate->ContactName != null ? $cooperate->ContactName : '-'?></td>
					</tr>
					<tr>
						<td class="width100">Số ĐT</td>
						<td><a href="tel:<?=$cooperate->ContactPhone?>"><?=$cooperate->ContactPhone != null ? $cooperate->ContactPhone : '-'?></a></td>
					</tr>

					<tr>
						<td class="width100">Địa chỉ</td>
						<td><?=$cooperate->ContactAddress != null ? $cooperate->ContactAddress : 'KXĐ'?></td>
					</tr>
					<tr>
						<td class="width100">Email</td>
						<td><?=$cooperate->ContactEmail != null ? $cooperate->ContactEmail : 'KXĐ'?></td>
					</tr>
				</table>
			</div>
			<div class="col-xs-12">
				<!-- Load Facebook SDK for JavaScript -->

				<div class="fb-comment-embed"
					 data-href="<?=base_url($_SERVER['REQUEST_URI'])?>"
					 data-width="500"></div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-6 col-xs-8">
				<div class="subscribe-panel col-md-12 no-padding">
					<div>
						<div class="facebookShare">
							<!-- Your share button code -->
							<div class="fb-share-button"
								 data-href="<?=base_url($_SERVER['REQUEST_URI'])?>"
								 data-size="large"
								 data-layout="button">
							</div>
						</div>
						<div class="googleShare">
							<!-- Place this tag where you want the share button to render. -->
							<div class="g-plus" data-action="share" data-height="32"></div>
						</div>
						<div class="clear-both"></div>
					</div>
				</div>
				<div class="clear-both"></div>
			</div>
			<div class="col-md-6 col-xs-4">
				<div class="copy-source row color-gray no-margin no-padding text-right">Ngày đăng: <?=date('d/m/Y', strtotime($cooperate->ModifiedDate))?></div>
			</div>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right no-padding-left-mobile">
		<?php $this->load->view('/common/branch-left') ?>
		<?php $this->load->view('/common/Search_filter') ?>
		<?php $this->load->view('/common/sample_house') ?>
		<div class="clear-both"></div>
		<?php $this->load->view('/Subscrible') ?>
		<div class="clear-both"></div>
		<img class="width100pc margin-bottom-20 mobile-hide" src="<?=base_url('/img/hoatraotay.jpg')?>" alt="Hoa Trao Tay"/>
	</div>

</div>


<?php $this->load->view('/theme/footer')?>
</div>

</body>

</html>
