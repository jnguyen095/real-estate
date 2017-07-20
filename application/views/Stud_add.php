<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Students Example</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="<?php echo base_url()?>js/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php $this->load->view('/theme/header')?>
<?php
	echo form_open('Stud_controller/add_student');
	echo form_label('Roll No.');
	echo form_input(array('id'=>'roll_no','name'=>'roll_no'));
	echo "<br/>";

	echo form_label('Name');
	echo form_input(array('id'=>'name','name'=>'name'));
	echo "<br/>";

	echo form_submit(array('id'=>'submit','value'=>'Add'));
	echo form_close();
?>
<?php $this->load->view('/theme/footer')?>
	</div>
</body>
</html>
