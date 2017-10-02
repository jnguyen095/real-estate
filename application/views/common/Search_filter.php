<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/27/2017
 * Time: 11:11 PM
 */

?>

<div class="search-panel block-panel fix-height-standard">
	<div class="block-header">TÌM KIẾM</div>
	<?php
	$attributes = array("name" => "search", "id" => "search_form", "class" => "custom-input");
	echo form_open("tim-kiem", $attributes);
	?>
	<div class="block-body">
		<div class="row">
			<input id="keyword" type="text" placeholder="Từ khóa" value="<?=isset($keyword) ? $keyword : ''?>" name="keyword"/>
		</div>
		<div class="row">
			<select id="cmCatId" name="cmCatId">
				<option value="-1">Tất cả loại tin</option>
				<?php
				if($categories != null && count($categories) > 0){
					foreach ($categories as $c){
						if($c->CatType == CAT_TYPE_SALE){
							?>
							<option value="<?=$c->CategoryID?>" <?=((isset($cmCatId) && $cmCatId == $c->CategoryID) ? ' selected="selected"' : '')?> ><?=$c->CatName?></option>
							<?php
							if(count($child[$c->CategoryID]) > 0){
								foreach ($child[$c->CategoryID] as $k){
									?>
									<option value="<?=$k->CategoryID?>" <?=((isset($cmCatId) && $cmCatId == $k->CategoryID) ? ' selected="selected"' : '')?> >&nbsp;&nbsp;&nbsp;&nbsp;<?=$k->CatName?></option>
									<?php
								}
							}
						}
					}
				}
				?>
			</select>
		</div>
		<div class="row">
			<select id="cmCityId" name="cmCityId">
				<option value="-1">Chọn tỉnh/thành phố</option>
				<?php
				if($cities != null && count($cities) > 0){
					foreach ($cities as $city){
						?>
						<option value="<?=$city->CityID?>" <?=(isset($cmCityId) && $cmCityId == $city->CityID)?'selected':''?>><?=$city->CityName?></option>
						<?php
					}
				}
				?>
			</select>
		</div>
		<div class="row">
			<select id="cmDistrictId" name="cmDistrictId">
				<option value="-1">Chọn quận/huyện</option>
				<?php
				if($districts != null && count($districts) > 0) {
					foreach ($districts as $dt) {
						?>
						<option
							value="<?= $dt->DistrictID ?>" <?= (isset($cmDistrictId) && $cmDistrictId == $dt->DistrictID) ? ' selected' : '' ?> ><?= $dt->DistrictName ?></option>
						<?php
					}
				}
				?>
			</select>
		</div>
		<div class="row">
			<select id="cmPrice" name="cmPrice">
				<option value="-1">Tất cả giá</option>
				<option value="0" <?=(isset($cmPrice) && $cmPrice == 0) ? 'selected' : ''?>>Thỏa thuận</option>
				<option value="1" <?=(isset($cmPrice) && $cmPrice == 1) ? 'selected' : ''?>>< 500 triệu</option>
				<option value="2" <?=(isset($cmPrice) && $cmPrice == 2) ? 'selected' : ''?>><1 tỷ</option>
				<option value="3" <?=(isset($cmPrice) && $cmPrice == 3) ? 'selected' : ''?>>1 - 2 tỷ</option>
				<option value="4" <?=(isset($cmPrice) && $cmPrice == 4) ? 'selected' : ''?>>2 - 3 tỷ</option>
				<option value="5" <?=(isset($cmPrice) && $cmPrice == 5) ? 'selected' : ''?>>3 - 5 tỷ</option>
				<option value="6" <?=(isset($cmPrice) && $cmPrice == 6) ? 'selected' : ''?>>5 - 7 tỷ</option>
				<option value="7" <?=(isset($cmPrice) && $cmPrice == 7) ? 'selected' : ''?>>7 - 10 tỷ</option>
				<option value="8" <?=(isset($cmPrice) && $cmPrice == 8) ? 'selected' : ''?>>10 - 20 tỷ</option>
				<option value="9" <?=(isset($cmPrice) && $cmPrice == 9) ? 'selected' : ''?>>> 20 tỷ</option>
			</select>
		</div>
		<div class="row">
			<select id="cmArea" name="cmArea">
				<option value="-1">Tất cả diện tích</option>
				<option value="0" <?=(isset($cmArea) && $cmArea == 0) ? 'selected' : ''?>>Không xác định</option>
				<option value="1" <?=(isset($cmArea) && $cmArea == 1) ? 'selected' : ''?>><= 30 m2</option>
				<option value="2" <?=(isset($cmArea) && $cmArea == 2) ? 'selected' : ''?>>30  - 50 m2</option>
				<option value="3" <?=(isset($cmArea) && $cmArea == 3) ? 'selected' : ''?>>50  - 80 m2</option>
				<option value="4" <?=(isset($cmArea) && $cmArea == 4) ? 'selected' : ''?>>80  - 100 m2</option>
				<option value="5" <?=(isset($cmArea) && $cmArea == 5) ? 'selected' : ''?>>100 - 150 m2</option>
				<option value="6" <?=(isset($cmArea) && $cmArea == 6) ? 'selected' : ''?>>150 - 200 m2</option>
				<option value="7" <?=(isset($cmArea) && $cmArea == 7) ? 'selected' : ''?>>>= 200 m2</option>
			</select>
		</div>

		<div class="row text-center">
			<a id="btnSearch" class="btn btn-tindatdai btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm Kiếm</a>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
