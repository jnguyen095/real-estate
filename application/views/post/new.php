<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/9/2017
 * Time: 2:19 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Tin Đất Đai | Đăng Tin Rao | Tạo Tin</title>
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<script src="<?= base_url('/ckeditor/ckeditor.js') ?>"></script>
		<?php $this->load->view('common_header')?>
		<script src="<?= base_url('/js/createPost.js') ?>"></script>
</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<?php if(!empty($error_message)){
				echo '<div class="alert alert-danger">';
				echo $error_message;
				echo '</div>';
			}?>

			<h1 class="h2title">ĐĂNG TIN</h1>
			<hr/>

			<!-- Step -->
			<div class="row smpl-step" style="border-bottom: 0; min-width: 500px;">
				<div class="col-xs-4 smpl-step-step complete">
					<div class="text-center smpl-step-num">Bước 1</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-edit" style="font-size: 35px; padding-left: 19px; padding-top: 16px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Soạn bài đăng</div>
				</div>

				<div class="col-xs-4 smpl-step-step ">
					<div class="text-center smpl-step-num">Bước 2</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-eye-open" style="font-size: 35px; padding-left: 17px; padding-top: 17px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Bản đồ</div>
				</div>
				<div class="col-xs-4 smpl-step-step ">
					<div class="text-center smpl-step-num">Bước 3</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a class="smpl-step-icon"><i class="glyphicon glyphicon-check" style="font-size: 35px; padding-left: 20px; padding-top: 15px; color: #fff;"></i></a>
					<div class="smpl-step-info text-center">Đăng bài</div>
				</div>
			</div>
			<!-- end -->

			<div class="col-lg-9 col-sm-9">
				<?php
					$attributes = array("enctype" => "multipart/form-data", "class" => "custom-input");
					echo form_open("dang-tin", $attributes);
				?>
				<div class="block-panel">
					<div class="block-header">THÔNG TIN CƠ BẢN</div>
					<div class="block-body">
						<div class="form-group">
							<div class="col-lg-12">
								<label>Tiêu đề <span class="required">*</span></label>
								<input type="text" id="txt_title" name="txt_title" value="<?=isset($title) ? $title : ''?>" class="form-control">
								<span class="text-danger"><?php echo form_error('txt_title'); ?></span>
							</div>
							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="col-lg-6">
								<label>Loại tin rao <span class="required">*</span></label>
								<select class="form-control" id="sl_category" name="sl_category">
									<option>Chọn loại tin</option>
									<?php
									if($categories != null && count($categories) > 0){
										foreach ($categories as $c){
											if($c->CatType == CAT_TYPE_SALE){?>
												<option value="<?=$c->CategoryID?>" <?=(isset($categoryID) && $categoryID == $c->CategoryID) ? ' selected="selected"' : ''?>><?=$c->CatName?></option>
												<?php
												if(count($child[$c->CategoryID]) > 0){
													foreach ($child[$c->CategoryID] as $k){?>
														<option value="<?=$k->CategoryID?>" <?=((isset($categoryID) && $categoryID == $k->CategoryID) ? ' selected="selected"' : '')?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$k->CatName?></option>
													<?php
													}
												}
											}
										}
									}
									?>
								</select>
								<span class="text-danger"><?php echo form_error('sl_category'); ?></span>
							</div>

							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="col-lg-4">
								<label>Giá</label>
								<input type="text" id="txt_price" name="txt_price" class="form-control" value="<?=isset($price) ? $price : ''?>">
								<span class="text-danger"><?php echo form_error('txt_price'); ?></span>
							</div>
							<div class="col-lg-2">
								<label>Đơn vị</label>
								<select class="form-control" name="txt_unit">
									<?php
									foreach ($units as $ut){
										?>
										<option value="<?=$ut->UnitID?>" <?=(isset($unit) && $unit == $ut->UnitID) ? ' selected': ''?> ><?=$ut->Title?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Diện tích(m²)</label>
								<input type="text" id="txt_area" name="txt_area" class="form-control" value="<?=isset($area) ? $area : ''?>">
								<span class="text-danger"><?php echo form_error('txt_area'); ?></span>
							</div>
							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="col-lg-6">
								<label>Thành phố <span class="required">*</span></label>
								<select id="txtCity" class="form-control" name="txt_city">
									<option value="-1">Chọn tỉnh/thành phố</option>
									<?php
									if($cities != null && count($cities) > 0){
										$str = '';
										foreach ($cities as $ct){
											?>
											<option value="<?=$ct->CityID?>" <?=(isset($city) && $city == $ct->CityID) ? ' selected' : ''?> ><?=$ct->CityName?></option>
											<?php
										}
									}
									?>
								</select>
								<span class="text-danger"><?php echo form_error('txt_city'); ?></span>
							</div>
							<div class="col-lg-6">
								<label>Quận/huyện <span class="required">*</span></label>
								<select id="txtDistrict" class="form-control" name="txt_district">
									<option>Chọn quận/huyện</option>
									<?php
									if($districts != null && count($districts) > 0) {
										foreach ($districts as $dt) {
											?>
											<option
												value="<?= $dt->DistrictID ?>" <?= (isset($district) && $district == $dt->DistrictID) ? ' selected' : '' ?> ><?= $dt->DistrictName ?></option>
											<?php
										}
									}
									?>
								</select>
								<span class="text-danger"><?php echo form_error('txt_district'); ?></span>
							</div>
							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="col-lg-6">
								<label>Phường/xã <span class="required">*</span></label>
								<select id="txtWard" class="form-control" name="txt_ward">
									<option>Chọn phường/xã</option>
									<?php
									if($wards != null && count($wards) > 0) {
										foreach ($wards as $wd) {
											?>
											<option
												value="<?= $wd->WardID ?>" <?= (isset($ward) && $ward == $wd->WardID) ? ' selected' : '' ?> ><?= $wd->WardName ?></option>
											<?php
										}
									}
									?>
								</select>
								<span class="text-danger"><?php echo form_error('txt_ward'); ?></span>
							</div>
							<div class="col-lg-6">
								<label>Đường <span class="required">*</span></label>
								<input type="text" id="txt_street" name="txt_street" class="form-control typeahead" value="<?=isset($street) ? $street : ''?>">
								<span class="text-danger"><?php echo form_error('txt_street'); ?></span>
							</div>
							<div class="clear-both"></div>
						</div>
					</div>
				</div><!-- end block basic -->

				<div class="block-panel">
					<div class="block-header">HÌNH ẢNH</div>
					<div class="block-body">
						<div class="form-group bordered-group">
							<div class="col-lg-12">
								<?php
								if (isset($image) && $image != null) {
									?>
									<div>
										<img src="<?= base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:100px; margin-bottom: 5px;">
									</div>

								<?php
								}
								?>
								<label>Hình đại diện <span class="required">*</span></label>
								<input type="file" id="txt_userfile" name="txt_userfile">
								<input type="hidden" id="txt_image" name="image" value="<?=isset($image) ? $image : ''?>"/>
								<input type="hidden" value="<?=$this->session->userdata('loginid')?>" name="txt_folder">
								<span class="text-danger"><?php echo form_error('txt_userfile'); ?></span>

							</div>
							<div class="clear-both"></div>
						</div>

						<div class="form-group bordered-group">
							<div class="others-images-container">
								<?=isset($other_images) ? $other_images : ''?>
							</div>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-info">Upload thêm hình</a>
						</div>
					</div>
				</div><!-- end image block -->

				<div class="form-group">
					<label>Mô tả chi tiết về tin rao<span class="required">*</span></label>
					<textarea name="description" id="description" rows="50" class="form-control"><?=isset($description) ? $description : ''?></textarea>
					<span class="text-danger"><?php echo form_error('description'); ?></span>
					<script>
						CKEDITOR.replace('description',{
							toolbar: [
								{ name: 'document', items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
								[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
								{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
								{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
								{ name: 'styles', items: [ 'Styles', 'Format' ] }
							]
						});
					</script>
				</div>

				<div class="form-group">
					<div class="col-md-6 no-padding-left">
						<table class="table tableBorder">
							<tbody>
								<tr class="tbHeader">
									<td colspan="2">Đặc Điểm</td>
								</tr>
								<tr>
									<td>Chiều rộng(m)</td>
									<td>
										<input id="txt_width" type="text" name="txt_width" class="form-control" value="<?=isset($width) ? $width : ''?>">
										<span class="text-danger"><?php echo form_error('txt_width'); ?></span>
									</td>
								</tr>
								<tr>
									<td>Chiều dài(m)</td>
									<td>
										<input id="txt_long" type="text" name="txt_long" class="form-control" value="<?=isset($long) ? $long : ''?>">
										<span class="text-danger"><?php echo form_error('txt_long'); ?></span>
									</td>
								</tr>
								<tr>
									<td>Số tầng</td>
									<td>
										<input id="txt_floor" type="text" name="txt_floor" class="form-control" value="<?=isset($floor) ? $floor : ''?>">
										<span class="text-danger"><?php echo form_error('txt_floor'); ?></span>
									</td>
								</tr>
								<tr>
									<td>Số phòng</td>
									<td>
										<input id="txt_room" type="text" name="txt_room" class="form-control" value="<?=isset($room) ? $room : ''?>">
										<span class="text-danger"><?php echo form_error('txt_room'); ?></span>
									</td>
								</tr>
								<tr>
									<td>Nhà vệ sinh</td>
									<td>
										<input id="txt_toilet" type="text" name="txt_toilet" class="form-control" value="<?=isset($toilet) ? $toilet : ''?>">
										<span class="text-danger"><?php echo form_error('txt_toilet'); ?></span>
									</td>
								</tr>
								<tr>
									<td>Hướng</td>
									<td>
										<select class="form-control" name="txt_direction">
											<option value="-1">KXĐ</option>
											<?php
											foreach ($directions as $dr){
												?>
												<option value="<?=$dr->DirectionID?>" <?=(isset($direction) && $direction == $dr->DirectionID) ? ' selected': ''?>><?=$dr->DirectionName?></option>
												<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Thuộc dự án</td>
									<td>
										<select class="form-control" name="txt_brand">
											<option value="-1">KXĐ</option>
											<?php
											foreach ($brands as $br){
												?>
												<option value="<?=$br->BrandID?>" <?=(isset($brand) && $brand == $br->BrandID) ? ' selected': ''?>><?=$br->BrandName?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6 no-padding-right">
						<table class="table tableBorder">
							<tbody>
								<tr class="tbHeader">
									<td colspan="2">Liên Hệ</td>
								</tr>
								<tr>
									<td class="width100">Liên hệ <span class="required">*</span></td>
									<td>
										<input id="contactName" name="txt_fullname" class="form-control" value="<?=(isset($contact_name) ? $contact_name : '')?>">
										<span class="text-danger"><?php echo form_error('contactName'); ?></span>
									</td>
								</tr>
								<tr>
									<td class="width100">Số ĐT <span class="required">*</span></td>
									<td>
										<input id="contactPhone" name="txt_phone" class="form-control" value="<?=(isset($contact_phone) ? $contact_phone : '')?>"/>
										<span class="text-danger"><?php echo form_error('contactPhone'); ?></span>
									</td>
								</tr>
								<tr>
									<td class="width100">Địa chỉ</td>
									<td>
										<input name="txt_address" class="form-control" value="<?=(isset($contact_address) ? $contact_address : '')?>"/>
									</td>
								</tr>
								<tr>
									<td class="width100">Email</td>
									<td><input name="txt_email" class="form-control" value="<?=(isset($txt_email) ? $txt_email : '')?>"/></td>
								</tr>
							</tbody>
						</table>

					</div>
					<div class="clear-both"></div>
				</div>

				<div class="row text-center">
					<input type="hidden" name="crudaction" value="add_new">
					<a class="btn btn-danger">Hủy bài</a>
					<button type="submit" class="btn btn-info">Xem trước</button>
				</div>
				<?php echo form_close(); ?>

				<!-- Modal upload images -->
				<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myModalLabel">Upload thêm hình</h4>
							</div>
							<div class="modal-body">
								<form id="uploadImagesForm">
									<input type="hidden" value="<?=$this->session->userdata('loginid')?>" name="txt_folder">
									<label for="others">Được chọn nhiều hình</label>
									<input type="file" name="others[]" id="others" multiple="">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info finish-upload">
									<span class="finish-text" style="display: inline;">Xong</span>
									<img src="<?=base_url('/img/load.gif')?>" class="loadUploadOthers" alt="" style="display: none;">
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- end modal upload images -->
			</div> <!-- end column 9 -->

			<div class="col-lg-3 col-sm-3">
				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HƯỚNG DẪN ĐĂNG TIN</div>
						<div class="guidline">
							<ul>
								<li>Thông tin có (<span class="required">*</span>) là bắt buộc nhập</li>
								<li>Hình đại diện để hiễn thị trang danh sách và tìm kiếm</li>
								<li>Chọn "Upload thêm hình" để có nhiều thông tin, được hiễn thị trong trang chi tiết.</li>
								<li>Chỉnh sửa thông tin liên hệ chỉ ảnh hưởng đến tin đăng hiện tại</li>
								<li>Viết tiếng việt có dấu để tăng hiệu quả và tìm kiếm</li>
							</ul>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	<script src="<?=base_url('/js/typeahead.bundle.min.js')?>"></script>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
