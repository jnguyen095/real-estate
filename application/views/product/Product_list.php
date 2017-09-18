<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<meta name="description" content="<?=$category->CatName?>">
	<meta name="keywords" content="Bất động sản, bán nhà, chung cư, mua đất, bán đất, real estate">
	<title>Tin Đất Đai | <?php echo $category->CatName?></title>
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
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
	<?php
	 if(count($sameLevels) > 0){
		 echo '<div class="category-panel col-md-12">';
		 foreach ($sameLevels as $level){
			 echo '<div class="col-md-4"><a href="'.base_url().seo_url($level->CatName).'-c'.$level->CategoryID.'.html">'.$level->CatName. ' </a></div>';
		 }
		 echo '</div>';
	 }
	?>
		<div class="product-panel col-md-12  no-margin no-padding">
			<?php
				foreach ($products as $product){
					echo '<div class="row product-list">';
					echo '<div class="row product-title"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html">'. $product->Title .'</a> </div>';

					echo '<div class="row product-content">';
					echo '<div class="col-md-2 col-xs-5 no-padding"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html"><img style="max-width: 120px" src="'.$product->Thumb.'" alt="'.$product->Title.'"/></a></div>';
					echo '<div class="col-md-10 col-xs-7">';
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
		<?php $this->load->view('/common/news_plot')?>
		<?php $this->load->view('/common/Search_filter') ?>
		<?php $this->load->view('/Subscrible') ?>
		<div class="clear-both"></div>
	</div>
</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
