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
		<meta name="description" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<meta name="keywords" content="Tin Bất động sản, Rao tin miễn phí, tin bất động sản miễn phí">
		<title>Tạo Tin Bất Động Sản | Đăng Tin Rao Miễn Phí</title>
		<script src="<?= base_url('/ckeditor/ckeditor.js') ?>"></script>
		<?php $this->load->view('common_header')?>
		<script src="<?= base_url('/js/createpost.min_v1.1.js') ?>"></script>
		<script src="<?=base_url('/admin/js/bootstrap-datepicker.min.js')?>"></script>
</head>
</head>
<body class="create-post">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<ul class="breadcrumb">
		<li><a href="<?=base_url('/trang-chu.html')?>">Trang chủ</a> </li>
		<li class="active">Đăng tin</li>
	</ul>

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12 no-padding">
			<?php if($this->session->userdata('loginid') < 1) { ?>
				<div class="alert alert-danger">
					<b>Bạn vẫn có thể tiếp tục đăng tin miễn phí mà không cần đăng nhập.</b><br/>
					Tuy nhiên, hãy <b><a href="<?=base_url('/dang-nhap.html')?>">đăng nhập</a></b> để đăng tin VIP và quản lý tin rao tốt hơn: lượt xem, làm mới tin, xem phản hồi,..
				</div>
				<?php
			}
			?>
			<?php if(!empty($error_message)){
				echo '<div class="alert alert-danger">';
				echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				echo $error_message;
				echo '</div>';
			}?>

			<h1 class="h2title">ĐĂNG TIN RAO BẤT ĐỘNG SẢN</h1>
			<hr/>

			<div class="col-lg-9 col-sm-9 no-padding-mobile">
				<?php
					$attributes = array("enctype" => "multipart/form-data", "class" => "custom-input");
					echo form_open("dang-tin", $attributes);
				?>
				<div class="block-panel">
					<div class="block-header">LỊCH ĐĂNG TIN</div>
					<div class="block-body">
						<div class="form-group">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<label>Gói tin <span class="required">*</span></label>
								<select id="sl_package" <?=$this->session->userdata('loginid') < 1 ? 'disabled' : '' ?> class="form-control" name="sl_package">
									<option value="standard" <?=(isset($sl_package) && $sl_package == 'standard') ? ' selected': ''?>>Tin thường</option>
									<option value="vip0" <?=(isset($sl_package) && $sl_package == 'vip0') ? ' selected': ''?>>Siêu Vip</option>
									<option value="vip1" <?=(isset($sl_package) && $sl_package == 'vip1') ? ' selected': ''?>>Vip 1</option>
									<option value="vip2" <?=(isset($sl_package) && $sl_package == 'vip2') ? ' selected': ''?>>Vip 2</option>
									<option value="vip3" <?=(isset($sl_package) && $sl_package == 'vip3') ? ' selected': ''?>>Vip 3</option>
								</select>
								<span class="text-danger"><?php echo form_error('sl_package'); ?></span>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<label>Ngày bắt đầu <span class="required">*</span></label>
								<input type="text" id="txt_fromdate" name="from_date" value="<?=isset($from_date) ? $from_date : ''?>" class="form-control from_date">
								<span class="text-danger"><?php echo form_error('from_date'); ?></span>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<label>Ngày kết thúc <span class="required">*</span></label>
								<input type="text" id="txt_todate" name="to_date" value="<?=isset($to_date) ? $to_date : ''?>" class="form-control to_date">
								<span class="text-danger"><?php echo form_error('to_date'); ?></span>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<label>Chi phí đăng tin</label>
								<div class="postCost">
									<span class="price" id="packagePrice"><?=$postCost?></span> đ
								</div>
							</div>
							<div class="clear-both"></div>
						</div>
					</div>
				</div>


				<div class="block-panel">
					<div class="block-header">THÔNG TIN CƠ BẢN</div>
					<div class="block-body">
						<div class="form-group">
							<div class="col-lg-12 no-padding-mobile">
								<label>Tiêu đề <span class="required">*</span></label>
								<input type="text" id="txt_title" name="txt_title" value="<?=isset($title) ? $title : ''?>" class="form-control">
								<span class="text-danger"><?php echo form_error('txt_title'); ?></span>
							</div>
							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="col-lg-6 no-padding-mobile">
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

							<div class="no-padding-mobile col-lg-2 col-md-4 col-xs-6">
								<label>Giá</label>
								<input type="text" placeholder="Thỏa thuận" id="txt_price" name="txt_price" class="form-control" value="<?=isset($price) ? $price : ''?>">
								<span class="text-danger"><?php echo form_error('txt_price'); ?></span>
							</div>
							<div class="no-padding-right-mobile col-lg-2 col-md-4 col-xs-6">
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
							<div class="no-padding-mobile col-lg-2 col-md-4 col-xs-12">
								<label>Diện tích(m²)</label>
								<input placeholder="KXĐ" type="text" id="txt_area" name="txt_area" class="form-control" value="<?=isset($area) ? $area : ''?>">
								<span class="text-danger"><?php echo form_error('txt_area'); ?></span>
							</div>

							<div class="clear-both"></div>
						</div>

						<div class="form-group">
							<div class="no-padding-mobile col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Thành phố <span class="required">*</span></label>
								<select id="txtCity" class="form-control" name="txt_city">
									<option>Chọn tỉnh/thành phố</option>
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
							<div class="no-padding-mobile col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
							<div class="no-padding-mobile col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Phường/xã</label>
								<select id="txtWard" class="form-control" name="txt_ward">
									<option value="-1">Chọn phường/xã</option>
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
							<div class="no-padding-mobile col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
							<a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-info">Upload hình chi tiết</a>
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

				<div class="block-panel">
					<div class="block-header">ĐẶC ĐIỂM BẤT ĐỘNG SẢN</div>
					<div class="block-body">
						<div class="form-group">
							<div class="form-group">
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Chiều rộng(m)</label>
									<input id="txt_width" type="text" name="txt_width" class="form-control" value="<?=isset($width) ? $width : ''?>">
									<span class="text-danger"><?php echo form_error('txt_width'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Chiều dài(m)</label>
									<input id="txt_long" type="text" name="txt_long" class="form-control" value="<?=isset($long) ? $long : ''?>">
									<span class="text-danger"><?php echo form_error('txt_long'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Số tầng</label>
									<input id="txt_floor" type="text" name="txt_floor" class="form-control" value="<?=isset($floor) ? $floor : ''?>">
									<span class="text-danger"><?php echo form_error('txt_floor'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Số phòng</label>
									<input id="txt_room" type="text" name="txt_room" class="form-control" value="<?=isset($room) ? $room : ''?>">
									<span class="text-danger"><?php echo form_error('txt_room'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Nhà vệ sinh</label>
									<input id="txt_toilet" type="text" name="txt_toilet" class="form-control" value="<?=isset($toilet) ? $toilet : ''?>">
									<span class="text-danger"><?php echo form_error('txt_toilet'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left-mobile">
									<label>Hướng</label>
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
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding-left-mobile">
									<label>Thuộc dự án</label>
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
								</div>
								<div class="clear-both"></div>
							</div>

						</div>
					</div>
				</div>

				<div class="block-panel">
					<div class="block-header">LIÊN HỆ</div>
					<div class="block-body">
						<div class="form-group">
							<div class="form-group">
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-mobile">
									<label>Liên hệ <span class="required">*</span></label>
									<input id="contactName" name="txt_fullname" class="form-control" value="<?=(isset($contact_name) ? $contact_name : '')?>">
									<span class="text-danger"><?php echo form_error('txt_fullname'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-mobile">
									<label>Số ĐT <span class="required">*</span></label>
									<input id="contactPhone" name="txt_phone" class="form-control" value="<?=(isset($contact_phone) ? $contact_phone : '')?>"/>
									<span class="text-danger"><?php echo form_error('txt_phone'); ?></span>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-mobile">
									<label>Địa chỉ</label>
									<input name="txt_address" class="form-control" value="<?=(isset($contact_address) ? $contact_address : '')?>"/>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-mobile">
									<label>Email</label>
									<input name="txt_email" class="form-control" value="<?=(isset($txt_email) ? $txt_email : '')?>"/>
									<span class="text-danger"><?php echo form_error('txt_email'); ?></span>
								</div>
								<div class="clear-both"></div>
							</div>

						</div>
					</div>
				</div>

				<div class="block-panel">
					<div class="block-header">BẢN ĐỒ - VỊ TRÍ <span class="required">(Thay đổi vị trí bằng cách click lên bản đồ)</span></div>
					<div class="block-body">
						<div id="map"></div>
					</div>
				</div>

				<div class="block-panel">
					<div class="block-header">XÁC THỰC THÔNG TIN</div>
					<div class="block-body">
						<div class="row">
							<div class="col-lg-2 col-md-4 col-sm-12">Mã xác thực: <span class="required">*</span></div>
							<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
								<input name="txt_captcha" class="form-control" value="<?=(isset($txt_captcha) ? $txt_captcha : '')?>"/>
								<span class="text-danger"><?php echo form_error('txt_captcha'); ?></span>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-8 col-xs-8 no-padding-left">
								<span id="captchaImg"><?=$capchaImg?></span><a id="changeCaptcha" data-toggle="tooltip" title="Đổi mã xác thực khác" class="margin-left-10"><i class="glyphicon glyphicon-refresh"></i> </a>
							</div>

						</div>
					</div>
				</div>


				<div class="row text-center bottom-buttons">
					<input type="hidden" name="crudaction" value="add_new">
					<input type="hidden" name="txt_lng">
					<input type="hidden" name="txt_lat">
					<button type="submit" class="btn btn-info">Đăng Bài</button>
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

			<div class="col-lg-3 col-sm-3 no-padding-mobile">
				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">CÁC GÓI TIN</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Siêu VIP: Hiễn thị trang chủ, có gắn ngôi sao, đứng đầu các trang tìm kiếm và các gợi ý</span></li>
								<li><span class="pullet"><span class="vip1-color">VIP-1</span>: Hiễn thị đầu trang tìm kiếm, tiêu đề màu đỏ, sau tin siêu VIP</span></li>
								<li><span class="pullet"><span class="vip2-color">VIP-2</span>: Tiêu đề màu cam, đứng sau tin Vip 1</span></li>
								<li><span class="pullet"><span class="vip3-color">VIP-3</span>: Tiêu đề màu vàng, đứng sau tin Vip 2</span></li>
								<li><span class="pullet"><span class="standard-color">Tin Thường</span>: Tiêu đề màu xanh, hiễn thị theo thứ tự giảm dần theo giờ đăng tin.</span></li>
								<li><i class="label label-success">Các tin VIP chỉ dành cho thành viên đăng ký</i></li>
								<li><a href="<?=base_url('/bao-gia-dich-vu.html')?>">Xem thêm thông tin thanh toán</a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HƯỚNG DẪN ĐĂNG TIN</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Thông tin có (<span class="required">*</span>) là bắt buộc nhập</span></li>
								<li><span class="pullet">Hình đại diện để hiễn thị trang danh sách và tìm kiếm</span></li>
								<li><span class="pullet">Chọn "Upload thêm hình" để có nhiều thông tin, được hiễn thị trong trang chi tiết</span></li>
								<li><span class="pullet">Chỉnh sửa thông tin liên hệ chỉ ảnh hưởng đến tin đăng hiện tại</span></li>
								<li><span class="pullet">Viết tiếng việt có dấu để tăng hiệu quả và tìm kiếm</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HÌNH ẢNH</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">"Hình đại diện" xuất hiện trang tìm kiếm và danh sách</span></li>
								<li><span class="pullet">"Upload thêm hình" hiễn thị trang chi tiết, nên có khoảng từ 2 - 5 ảnh sẻ trực quan hơn</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">LIÊN HỆ</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Thông tin liên hệ sẻ xuất hiện trang chi tiết, để người cần thông tin liên hệ mua bán</span></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>
	<script src="<?=base_url('/js/typeahead.bundle.min.js')?>"></script>
	<script src="<?=base_url('/js/bootbox.min.js')?>"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_KEY?>&callback=defaultMap"></script>
	<?php $this->load->view('/theme/footer')?>
	<script>
		$(document).ready(function(){
			<?php
			if(isset($lat) && $lat > 0 && isset($lng) && $lng > 0) {
				?>
				loadMap(<?=$lat?>, <?=$lng?>, '<?=$address?>');
				<?php
			}
			?>

			$('.from_date').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true,
				startDate: '<?=$from_date?>'
			}).on('changeDate', function (selected) {
				var startDate = new Date(selected.date.valueOf());
				$('.to_date').datepicker('setStartDate', startDate);
			}).on('clearDate', function (selected) {
				$('.to_date').datepicker('setStartDate', null);
			});

			$(".to_date").datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true,
				startDate: '<?=$from_date?>'
			}).on('changeDate', function (selected) {
				var endDate = new Date(selected.date.valueOf());
				$('.from_date').datepicker('setEndDate', endDate);
			}).on('clearDate', function (selected) {
				$('.from_date').datepicker('setEndDate', null);
			});
		});
	</script>

	<div class="overlay" style="display: none"><img src="<?=base_url('/img/load.gif')?>"/></div>
</div>

</body>
</html>
