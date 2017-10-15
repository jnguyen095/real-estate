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
	<meta name="description" content="<?=$category->CatName?>">
	<meta name="keywords" content="<?=keyword_maker($category->CatName)?>">
	<meta name="revisit-after" content="1 days" />
	<meta name="robots" content="follow" />
	<title><?php echo $category->CatName?></title>
	<?php $this->load->view('common_header')?>
	<?php $this->load->view('/common/googleadsense')?>
	<?php $this->load->view('/common/facebook-pixel-tracking')?>
</head>

<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">

<?php $this->load->view('/theme/header')?>

<ul class="breadcrumb">
	<?php
		if(isset($category->Parent)){
			echo '<li><a href="'.base_url().seo_url($category->Parent->CatName).'-c'.$category->Parent->CategoryID.'.html">'.$category->Parent->CatName.'</a></li>';
		}
	?>
	<li class="active"><?php echo $category->CatName?></li>
	<?php $this->load->view('/common/quick-search')?>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">

		<?php
		 if(count($sameLevels) > 0){
			 echo '<div class="category-panel col-md-12 affix-top"  data-spy="affix" data-offset-top="90">';
			 echo '<div class="container mcontainer">';
			 foreach ($sameLevels as $level){
				 echo '<div class="col-md-4"><a href="'.base_url().seo_url($level->CatName).'-c'.$level->CategoryID.'.html">'.$level->CatName. ' </a></div>';
			 }
			 echo '<div class="clear-both"></div></div></div>';
		 }
		?>



		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				foreach ($products as $product){
					?>
					<div class="row product-list vip<?=$product->Vip?>">
						<div class="row product-title"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><?=($product->Vip < 5 ? '<span class="pvip">v'.$product->Vip.'</span>' :  '')?><h3><?=$product->Title?></h3></a> </div>
						<div class="row product-content">
							<div class="col-md-2 col-xs-3 no-padding"><a href="<?=base_url().seo_url($product->Title).'-p'.$product->ProductID?>.html"><img class="width100pc" style="max-width: 120px" src="<?=$product->Thumb?>" alt="<?=$product->Title?>"/></a></div>
							<div class="col-md-10 col-xs-9">
								<div class="row pos-relative">
									<div class="productTop">
										<div class="col-md-10 col-xs-12 no-padding"><span>Giá: <span class="color bold price"><?=$product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?=is_numeric($product->Area) ? $product->Area.' m²' : $product->Area?></span></span><span class="margin-left-10">Quận/Huyện: <span class="color bold"><?=$product->district.', '.$product->city?></span></div>
										<div class="col-md-2 color bold mobile-hide relative-time no-padding text-right"><?=date('d/m/Y', strtotime($product->ModifiedDate))?></div>
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
		<?php $this->load->view('/common/city-cat-left-link')?>
		<?php $this->load->view('/common/news_plot')?>
		<div class="clear-both"></div>

	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
