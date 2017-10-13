<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/13/2017
 * Time: 1:25 PM
 */
?>
<div class="quickSearch pull-right">
	<form class="navbar-form" action="<?=base_url('/tim-kiem.html')?>" role="search">
		<div class="input-group">
			<div class="input-group-btn">
				<select name="type" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<option value="all">Tất cả</option>
					<option value="sale">Bđs bán</option>
					<option value="rent">Cho thuê</option>
				</select>
			</div>
			<input id="txtQuery" type="text" name="query" class="form-control" placeholder="tìm kiếm">
			<div class="input-group-btn">
				<button id="btnQuickSearch" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
	</form>
</div>
<div class="clear-both"></div>
