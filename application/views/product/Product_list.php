<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title><?php echo $category->CatName?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/mcustome.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
</head>

<body>
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
	<div class="product-panel col-md-9  no-margin no-padding">
	<?php
		foreach ($products as $product){
			echo '<div class="row product-list">';
			echo '<div class="row product-title"><a href="'.base_url().seo_url($product->Title).'-p'.$product->ProductID.'.html">'. $product->Title .'</a> </div>';
			echo '<div class="row product-content">';
			echo '<div class="col-md-2 col-xs-4 no-padding"><img src="'.$product->Thumb.'"/></div>';
			echo '<div class="col-md-10 col-xs-8">';
			echo '<div class="product-brief">'. $product->Brief . '</div>';
			echo '<div class="price-info float-left"><span>Giá: <span class="color bold">'.$product->PriceString.'</span></span>';
			echo '<span class="margin-left-10">Diện tích: <span class="color bold">'.$product->Area.'</span></span>';
			echo '<span class="margin-left-10">Quận/Huyện: <span class="color bold">'.$product->Area.'</span></span>';
			echo '</div>';
			echo '<div class="float-right color bold">'.relative_time($product->PostDate).'</div>';
			echo '<div class="clear-both"></div>';

			echo '</div>';
			echo '</div>';

			echo '</div>';
		}
	?>
		<div class="row text-center">
			<?php echo $pagination ?>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right">
		<div class="product-panel col-md-12 no-margin no-padding">
			<input type="text" placeholder="Tìm kiếm">
		</div>
	</div>


</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
