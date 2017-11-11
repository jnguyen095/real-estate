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
		<title>Tìm Đối Tác, Hợp Tác, Bất Động Sản</title>
		<link rel="stylesheet" href="<?=base_url('/css/stepbar.css')?>">
		<script src="<?= base_url('/ckeditor/ckeditor.js') ?>"></script>
		<?php $this->load->view('common_header')?>
		<script src="<?= base_url('/js/createpost.min_v1.1.js') ?>"></script>
</head>
</head>
<body class="create-post">
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>
	
	<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?=base_url('hop-tac.html')?>"><span itemprop="name">Hợp tác</span></a><meta itemprop="position" content="1" /></li>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active"><span itemprop="item"><span itemprop="name">Tìm đối tác, hợp tác</span></span><meta itemprop="position" content="2" /></li>
		<?php $this->load->view('/common/quick-search')?>
	</ul>
	

	<div class="row no-margin">
		<div class="col-lg-12 col-sm-12 no-padding">
			<?php if($this->session->userdata('loginid') < 1) { ?>
				<div class="alert alert-danger">
					<b>Bạn vẫn có thể tiếp tục đăng tin miễn phí mà không cần đăng nhập.</b><br/>
					Tuy nhiên, hãy <b><a href="<?=base_url('/dang-nhap.html')?>">đăng nhập</a></b> để quản lý tin đăng tốt hơn: lượt xem, làm mới tin, xem phản hồi,..
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

			<h1 class="h2title">ĐĂNG TIN HỢP TÁC BẤT ĐỘNG SẢN</h1>
			<hr/>

			<div class="col-lg-9 col-sm-9 no-padding-mobile">
				<?php
					$attributes = array("enctype" => "multipart/form-data", "class" => "custom-input");
					echo form_open("dang-tin-hop-tac", $attributes);
				?>
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
										<img src="<?=base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:100px; margin-bottom: 5px;">
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
					</div>
				</div><!-- end image block -->

				<div class="block-panel">
					<div class="block-header">NỘI DUNG CHI TIẾT<span class="required">*</span></div>
					<div class="block-body">
						<div class="form-group">
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
					</div>
				</div>

				<div class="block-panel">
					<div class="block-header">LIÊN HỆ<span class="required">*</span></div>
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



				<div class="row text-center bottom-buttons">
					<input type="hidden" name="crudaction" value="add_new">
					<input type="hidden" name="txt_lng">
					<input type="hidden" name="txt_lat">
					<button type="submit" class="btn btn-info">Đăng Bài</button>
				</div>
				<?php echo form_close(); ?>


			</div> <!-- end column 9 -->

			<div class="col-lg-3 col-sm-3 no-padding-mobile">
				<div class="subscribe-panel col-md-12 no-padding">
					<div class="well">
						<div class="row text-center panel-title">HƯỚNG DẪN ĐĂNG TIN</div>
						<div class="guidline">
							<ul>
								<li><span class="pullet">Thông tin có (<span class="required">*</span>) là bắt buộc nhập</span></li>
								<li><span class="pullet">Chọn loại tin rao phù hợp sẻ tiếp cận đúng người mua/bán</span></li>
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
	<?php $this->load->view('/theme/footer')?>

</div>
</body>
</html>
