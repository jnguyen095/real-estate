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
	<div class="block-body">
		<div class="row">
			<select name="catId">
				<option>Tất cả loại tin</option>
				<?php
				if($categories != null && count($categories) > 0){
					foreach ($categories as $c){
						if($c->CatType == CAT_TYPE_SALE){
							echo '<option value="'.$c->CategoryID.'" '.(($category->CategoryID == $c->CategoryID) ? ' selected="selected"' : '').'>'.$c->CatName.'</option>';
							if(count($child[$c->CategoryID]) > 0){
								foreach ($child[$c->CategoryID] as $k){
									echo '<option value="'.$k->CategoryID.'" '.(($category->CategoryID == $k->CategoryID) ? ' selected="selected"' : '').'>&nbsp;&nbsp;&nbsp;&nbsp;'.$k->CatName.'</option>';
								}
							}
						}
					}
				}
				?>
			</select>
		</div>
		<div class="row">
			<select name="cityId">
				<option>Chọn tỉnh/thành phố</option>
				<?php
				if($cities != null && count($cities) > 0){
					foreach ($cities as $city){
						echo '<option>'.$city->CityName.'</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="row">
			<select name="districtId">
				<option>Chọn quận/huyện</option>
			</select>
		</div>
		<div class="row">
			<select name="area">
				<option>Chọn diện tích</option>
				<option value="-1">Chưa xác định</option>
				<option value="1"><= 30 m2</option>
				<option value="2">30  - 50 m2</option>
				<option value="3">50  - 80 m2</option>
				<option value="4">80  - 100 m2</option>
				<option value="5">100 - 150 m2</option>
				<option value="6">150 - 200 m2</option>
				<option value="7">250 - 300 m2</option>
				<option value="8">300 - 500 m2</option>
				<option value="9">>= 500 m2</option>
			</select>
		</div>
		<div class="row">
			<select name="price">
				<option>Chọn mức giá</option>
				<option value="-1">Thỏa thuận</option>
				<option value="1">< 500 triệu</option>
				<option value="2">500 - 800 triệu</option>
				<option value="3">800 triệu - 1 tỷ</option>
				<option value="4">1 - 2 tỷ</option>
				<option value="5">2 - 3 tỷ</option>
				<option value="6">3 - 4 tỷ</option>
				<option value="7">4 - 5 tỷ</option>
				<option value="8">5 - 7 tỷ</option>
				<option value="9">7 - 10 tỷ</option>
				<option value="10">10 - 20 tỷ</option>
				<option value="11">20 - 30 tỷ</option>
				<option value="12">> 30 tỷ</option>
			</select>
		</div>
		<div class="row">
			<select name="price">
				<option>Ngày đăng tin</option>
				<option value="-1">Hôm nay</option>
				<option value="1">Hôm qua</option>
				<option value="2">2 ngày qua</option>
				<option value="3">5 ngày qua</option>
				<option value="4">7 ngày qua</option>
				<option value="5">30 ngày qua</option>
			</select>
		</div>
		<div class="row text-center">
			<a class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Tìm Kiếm</a>
		</div>
	</div>
</div>
