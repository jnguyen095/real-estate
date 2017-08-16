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
		<title>Đăng tin rao</title>
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<script src="<?= base_url('/ckeditor/ckeditor.js') ?>"></script>
		<?php $this->load->view('common_header')?>
</head>
</head>
<body>

<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin rao</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12">
			<h1 class="h2title">ĐĂNG TIN RAO</h1>
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
					<div class="smpl-step-info text-center">Xem trước</div>
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

			<?php
				$attributes = array("enctype" => "multipart/form-data");
				echo form_open("dang-tin", $attributes);
			?>
			<div class="form-group">
				<label>Tiêu đề <span class="required">*</span></label>
				<input type="text" id="txt_title" name="txt_title" value="<?=isset($title) ? $title : ''?>" class="form-control">
				<span class="text-danger"><?php echo form_error('txt_title'); ?></span>
			</div>

			<div class="form-group">
				<div class="col-lg-6 no-padding-left">
					<label>Loại tin rao <span class="required">*</span></label>
					<select class="form-control" id="sl_category" name="sl_category">
						<option>Chọn loại tin</option>
						<?php
						if($categories != null && count($categories) > 0){
							foreach ($categories as $c){
								if($c->CatType == CAT_TYPE_SALE){
									echo '<option value="'.$c->CategoryID.'" '.(($categoryID == $c->CategoryID) ? ' selected="selected"' : '').'>'.$c->CatName.'</option>';
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
					<span class="text-danger"><?php echo form_error('sl_category'); ?></span>
				</div>
				<div class="col-lg-3 no-padding-left">
					<label>Giá</label>
					<input type="text" id="txt_price" name="txt_price" class="form-control">
					<span class="text-danger"><?php echo form_error('txt_price'); ?></span>
				</div>
				<div class="col-lg-3 no-padding-right">
					<label>Diện tích</label>
					<input type="text" id="txt_area" name="txt_area" class="form-control">
					<span class="text-danger"><?php echo form_error('txt_area'); ?></span>
				</div>

				<div class="clear-both"></div>
			</div>

			<div class="form-group">
				<div class="col-lg-3 no-padding-left">
					<label>Thành phố <span class="required">*</span></label>
					<select class="form-control" name="txt_city">
						<option>Chọn tỉnh/thành phố</option>
						<?php
						if($cities != null && count($cities) > 0){
							foreach ($cities as $city){
								echo '<option>'.$city->CityName.'</option>';
							}
						}
						?>
					</select>
					<span class="text-danger"><?php echo form_error('txt_city'); ?></span>
				</div>
				<div class="col-lg-2 no-padding-left">
					<label>Quận/huyện <span class="required">*</span></label>
					<select class="form-control" name="txt_district">
						<option>Chọn quận/huyện</option>
					</select>
					<span class="text-danger"><?php echo form_error('txt_district'); ?></span>
				</div>
				<div class="col-lg-2 no-padding-left">
					<label>Phường/xã <span class="required">*</span></label>
					<select class="form-control" name="txt_ward">
						<option>Chọn phường/xã</option>
					</select>
					<span class="text-danger"><?php echo form_error('txt_ward'); ?></span>
				</div>
				<div class="col-lg-5 no-padding-right">
					<label>Đường <span class="required">*</span></label>
					<input type="text" id="txt_street" name="txt_street" class="form-control">
					<span class="text-danger"><?php echo form_error('txt_street'); ?></span>
				</div>
				<div class="clear-both"></div>
			</div>

			<div class="form-group bordered-group">
				<label>Hình đại diện <span class="required">*</span></label>
				<input type="file" id="txt_userfile" name="txt_userfile">
				<span class="text-danger"><?php echo form_error('txt_userfile'); ?></span>
			</div>

			<div class="form-group bordered-group">
				<div class="others-images-container">

				</div>
				<a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-info">Upload thêm hình</a>
			</div>

			<div class="form-group">
				<label>Mô tả <span class="required">*</span></label>
				<textarea name="description" id="description" rows="50" class="form-control"></textarea>
				<span class="text-danger"><?php echo form_error('description'); ?></span>
				<script>
					CKEDITOR.replace('description');
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
								<td>Chiều rộng</td>
								<td><input type="text" name="txt_" class="form-control"></td>
							</tr>
							<tr>
								<td>Chiều dài</td>
								<td><input type="text" name="txt_" class="form-control"></td>
							</tr>
							<tr>
								<td>Số tầng</td>
								<td><input type="text" name="txt_" class="form-control"></td>
							</tr>
							<tr>
								<td>Số phòng</td>
								<td><input type="text" name="txt_" class="form-control"></td>
							</tr>
							<tr>
								<td>Nhà vệ sinh</td>
								<td><input type="text" name="txt_" class="form-control"></td>
							</tr>
							<tr>
								<td>Hướng</td>
								<td>
									<select class="form-control" name="txt_direction">
										<option value="-1">KXĐ</option>
										<option value="B">Bắc</option>
										<option value="N">Nam</option>
										<option value="T">Tây</option>
										<option value="D">Đông</option>
										<option value="DB">Đông-Bắc</option>
										<option value="TB">Tây-Bắc</option>
										<option value="TN">Tây-Nam</option>
										<option value="DN">Đông-Nam</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Thuộc dự án</td>
								<td>
									<select class="form-control" name="txt_direction">
										<option value="-1">KXĐ</option>
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
								<td class="width100">Liên hệ</td>
								<td><?=$user->FullName?></td>
							</tr>
							<tr>
								<td class="width100">Số ĐT</td>
								<td>
									<input name="txt_phone" class="form-control" value="<?=$user->Phone?>"/>
								</td>
							</tr>
							<tr>
								<td class="width100">Địa chỉ</td>
								<td>
									<input name="txt_address" class="form-control" value="<?=$user->Address?>"/>
								</td>
							</tr>
							<tr>
								<td class="width100">Email</td>
								<td><input name="txt_email" class="form-control" value="<?=$user->Email?>"/></td>
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

		</div>
	</div>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
