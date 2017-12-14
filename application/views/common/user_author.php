<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>
<?php
if(isset($userAuthor)) {
	?>
	<div class="search-panel block-panel">
		<div class="bg-success">LIÊN HỆ</div>

		<div class="block-body">
			<div class="row no-margin">
				<div class="col-xs-2"><i class="glyphicon glyphicon-user"></i></div>
				<div class="col-xs-10 text-left"><?=$userAuthor->FullName?></div>
			</div>
				
			
			<?php
			if(isset($userAuthor->Phone)) {
				?>
				<div class="row no-margin">
					<div class="col-xs-2"><i class="glyphicon glyphicon-phone"></i></div>
					<div class="col-xs-10 text-left"><?=$userAuthor->Phone?></div>
				</div>
				<?php
			}
			?>

			<?php
			if(isset($userAuthor->Email)) {
				?>
				<div class="row no-margin">
					<div class="col-xs-2"><i class="glyphicon glyphicon-envelope"></i></div>
					<div class="col-xs-10 text-left"><?=$userAuthor->Email?></div>
				</div>
				<?php
			}
			?>

			<?php
			if(isset($userAuthor->Address)) {
			?>
				<div class="row no-margin">
					<div class="col-xs-2"><i class="glyphicon glyphicon-home"></i></div>
					<div class="col-xs-10 text-left"><?=$userAuthor->Address?></div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
?>
