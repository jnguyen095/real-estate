<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Tin Đất Đai - Trang Chủ</title>
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

<a href = "<?php echo base_url(); ?>index.php/stud/add_view">Add</a>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
