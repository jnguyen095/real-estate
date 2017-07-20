<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Students Example</title>
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
	<li><a href="#">Home</a></li>
	<li><a href="#">Private</a></li>
	<li><a href="#">Pictures</a></li>
	<li class="active">Vacation</li>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="product-title"><?php echo $product->Title?></div>
		<div>Khu vực: <span class="color bold">
			<?php
				echo $product->Street->StreetName.' - '.$product->Ward->WardName.' - '.$product->District->DistrictName.' - '.$product->City->CityName
			?>
		</span></div>
		<div>Giá: <span class="color bold"><?php echo $product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?php echo $product->Area?></span></span></div>
		<div><?php echo $product->Detail?></div>
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
