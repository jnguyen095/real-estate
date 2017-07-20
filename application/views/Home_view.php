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

<a href = "<?php echo base_url(); ?>index.php/stud/add_view">Add</a>

<table border = "1">
	<?php
	$i = 1;
	echo "<tr>";
	echo "<td>Sr#</td>";
	echo "<td>Roll No.</td>";
	echo "<td>Name</td>";
	echo "<td>Edit</td>";
	echo "<td>Delete</td>";
	echo "<tr>";

	foreach($categories as $r) {
		echo "<tr>";
		echo "<td>".$i++."</td>";
		echo "<td>".$r->CategoryID."</td>";
		echo "<td>".$r->CatName."</td>";
		echo "<td><a href = '".base_url()."stud/edit/"
			.$r->CategoryID.".html'>Edit</a></td>";
		echo "<td><a href = '".base_url()."stud/delete/"
			.$r->CategoryID.".html'>Delete</a>";
		echo "<a href=". site_url('welcome/register'); " >Register</a></td>";
		echo "<tr>";
	}
	?>
</table>
<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
