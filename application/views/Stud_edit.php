<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title>Students Example</title>
</head>

<body>
<?php $this->load->view('/theme/header')?>
<form method = "" action = "">

	<?php
	echo form_open('Stud_controller/update_student');
	echo form_hidden('old_roll_no',$old_roll_no);
	echo form_label('Roll No.');
	echo form_input(array('id'=>'roll_no',
               'name'=>'roll_no','value'=>$records[0]->roll_no));
            echo "
            ";

            echo form_label('Name');
            echo form_input(array('id'=>'name','name'=>'name',
               'value'=>$records[0]->Name));
            echo "";

            echo form_submit(array('id'=>'sub mit','value'=>'Edit'));
            echo form_close();
         ?>

</form>
<?php $this->load->view('/theme/footer')?>
</body>

</html>
