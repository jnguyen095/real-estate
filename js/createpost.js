/**
 * Created by Ban Vien on 8/1/2017.
 */

$(document).ready(function(){
	uploadMultipleImages();
	loadDistrictByCityId();
	loadWardByDistrictId();
	autoComplete();
	deletePostHandler();
	refreshPostHandler();
	activePostHandler();
	inactivePostHandler();
	$("#txtWard").change(function(){
		getGeoFromAddress();
	});
	$("#sl_package").change(function(){
		calculatePrice();
	});
	$("#txt_fromdate").change(function(){
		calculatePrice();
	})
	$("#txt_todate").change(function(){
		calculatePrice();
	})


});

function calculatePrice(){
	var package = $("#sl_package").val();
	var fromDate = $("#txt_fromdate").val();
	var toDate = $("#txt_todate").val();
	$(".overlay").show();
	jQuery.ajax({
		type: "POST",
		url: urls.loadPrice4Package,
		dataType: 'json',
		data: {package: package, from_date: fromDate, to_date: toDate},
		success: function(data){
				var status = data.status;
				var value = data.val;
			if(status == 'no_authenticated'){
				$('#sl_package').val('standard');
				bootbox.alert("Phải đăng nhập để sử dụng các gói tin VIP của Tin Đất Đai.", function(){
				});
			}else if(status == 'free_cost'){
				$("#packagePrice").html(value);
			}else if(status == 'not_enough_quota'){
				$('#sl_package').val('standard');
				$("#packagePrice").html(value);
				bootbox.alert("Tài khoản không đủ để thanh toán, vui lòng nạp thêm tiền vào tài khoản.<br/><a href='"+urls.base_url+"bao-gia-dich-vu.html'>Hướng dẫn nạp tiền</a>", function(){
				});
			}else if(status == 'valid_payment'){
					$("#packagePrice").html(value);
			}else if(status == 'not_qualify_input'){
				$("#packagePrice").html(value);
			}
			$(".overlay").hide();
		}
	});
}

function inactivePostHandler(){
	$('.inactive-post').click(function(){
		var prId = $(this).data('post');
		bootbox.confirm("Bạn đã chắc chắn không hiễn thị tin rao này?", function(result){
			if(result){
				$("#productId").val(prId);
				$("#crudaction").val("inactive");
				$("#frmPost").submit();
			}
		});
	});
}

function activePostHandler(){
	$('.active-post').click(function(){
		var prId = $(this).data('post');
		$("#productId").val(prId);
		$("#crudaction").val("active");
		$("#frmPost").submit();
	});
}

function deletePostHandler(){
	$('.remove-post').click(function(){
		var prId = $(this).data('post');
		bootbox.confirm("Bạn đã chắc chắn xóa tin rao này chưa?", function(result){
			if(result){
				$("#productId").val(prId);
				$("#crudaction").val("delete");
				$("#frmPost").submit();
			}
		});
	});
}

function refreshPostHandler(){
	$('.refresh-post').click(function(){
		var prId = $(this).data('post');
		$("#productId").val(prId);
		$("#crudaction").val("refresh");
		$("#frmPost").submit();
	});
}

function autoComplete(){

	if($('.typeahead').length > 0) {
		$('.typeahead').typeahead({
				hint: true,
				highlight: true,
				minLength: 2
			},
			{
				name: 'states',
				async: true,
				displayKey: 'Street',
				source: function (query, process) {
					return $.get(urls.findStreetByNameUrl, {query: query}, function (data) {
						getGeoFromAddress();
						if (data != null && data.length > 0) {
							var json = $.parseJSON(data);
							getGeoFromAddress();
							return process(json);
						}

					});

				}
			});
	}
}

function loadWardByDistrictId(){
	$("#txtDistrict").change(function(){
		var districtId = $(this).val();
		$(".overlay").show();
		jQuery.ajax({
			type: "POST",
			url: urls.loadWardByDistrictId,
			dataType: 'json',
			data: {districtId: districtId},
			success: function(res){
				document.getElementById("txtWard").options.length = 1;
				for(key in res){
					$("#txtWard").append("<option value='"+res[key].WardID+"'>"+res[key].WardName+"</option>");
				}
				getGeoFromAddress();
				$(".overlay").hide();
			}
		});
	});
}

function loadDistrictByCityId(){
	$("#txtCity").change(function(){
		$(".overlay").show();
		var cityId = $(this).val();
		document.getElementById("txtWard").options.length = 1;
		jQuery.ajax({
			type: "POST",
			url: urls.loadDistrictByCityId,
			dataType: 'json',
			data: {cityId: cityId},
			success: function(res){
				document.getElementById("txtDistrict").options.length = 1;
				for(key in res){
					$("#txtDistrict").append("<option value='"+res[key].DistrictID+"'>"+res[key].DistrictName+"</option>");
				}
				getGeoFromAddress();
				$(".overlay").hide();
			}
		});
	});
}

function uploadMultipleImages(){
	$('.finish-upload').click(function () {
		$('.finish-upload .finish-text').hide();
		$('.finish-upload .loadUploadOthers').show();
		var someFormElement = document.getElementById('uploadImagesForm');
		var formData = new FormData(someFormElement);
		$.ajax({
			url: urls.uploadOthersImages,
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function (data)
			{
				var ok = true;
				if(data != null && data.length > 0){
					var json = $.parseJSON(data);
					if(json.error != null && json.error.length > 0){
						ok = false;
					}
				}
				if(ok){
					reloadOthersImagesContainer();
				}
				$('.finish-upload .finish-text').show();
				$('.finish-upload .loadUploadOthers').hide();
				$('#modalMoreImages').modal('hide');
				document.getElementById("uploadImagesForm").reset();
			}
		});

	});
}

function reloadOthersImagesContainer() {
	$('.others-images-container').empty();
	$('.others-images-container').load(urls.loadOthersImages, {"txt_folder": $('[name="txt_folder"]').val()});
}

function removeSecondaryProductImage(image, folder, container) {
	$.ajax({
		type: "POST",
		url: urls.removeSecondaryImage,
		data: {image: image, txt_folder: folder}
	}).done(function (data) {
		$('#image-container-' + container).remove();
	});
}

function updateCoordinators(productId, lng, lat) {
	$.ajax({
		type: "POST",
		url: urls.updateCoordinatorMapUrl,
		data: {productId: productId, lng: lng, lat: lat}
	}).done(function (data) {
	});
}

var _map, _marker;
var infoWindow;
function defaultMap(){
	infoWindow = new google.maps.InfoWindow;
	var uluru = {lat: 14.0583, lng: 108.2772};
	_map = new google.maps.Map(document.getElementById('map'), {
		zoom: 5,
		center: uluru
	});
	_marker = new google.maps.Marker({
		position: uluru,
		map: _map,
		label: 'K'
	});

	var infowincontent = document.createElement('div');
	var strong = document.createElement('strong');
	strong.textContent = 'Việt Nam';
	infowincontent.appendChild(strong);

	google.maps.event.addListener(_map, 'click', function(event) {
		_marker.setPosition(event.latLng);
		$("input[name=txt_lng]").val(event.latLng.lng());
		$("input[name=txt_lat]").val(event.latLng.lat());
	});

	// Open by default
	infoWindow.setContent(infowincontent);
	infoWindow.open(_map, _marker);
}

function initMap(_lat, _lng, _addr) {
	var uluru = {lat: _lat, lng: _lng};
	_map.setZoom(17);
	_map.setCenter(uluru);
	_marker.setPosition(uluru);
	var strong = document.createElement('strong');
	strong.textContent = _addr;
	var infowincontent = document.createElement('div');
	infowincontent.appendChild(strong);
	infoWindow.setContent(infowincontent);
	infoWindow.open(_map, _marker);
	_marker.addListener('click', function() {
		infoWindow.setContent(infowincontent);
		infoWindow.open(_map, _marker);
	});
}

var _oldAddr = null;
function getGeoFromAddress(){
	var txtCity = $("#txtCity").val();
	var txtDistrict = $("#txtDistrict").val();
	var txtWard = $("#txtWard").val();
	var txtStreet = $("#txt_street").val();
	var addr = '';
	if(txtStreet.length > 1){
		addr = txtStreet + ', ';
	}
	if(!isNaN(txtWard) && txtWard > 0){
		addr += $("#txtWard option:selected").text()  + ', ';
	}
	if(!isNaN(txtDistrict) && txtDistrict > 0){
		addr += $("#txtDistrict option:selected").text()  + ', ';
	}
	if(!isNaN(txtCity) && txtCity > 0){
		addr += $("#txtCity option:selected").text()  + ', ';
	}
	if(addr.length > 2) {
		addr = addr.substr(0, addr.length - 2);
	}
	if(_oldAddr != addr){
		_oldAddr = addr;
		jQuery.ajax({
			type: "POST",
			url: urls.loadGeoFromAddrUrl,
			dataType: 'json',
			data: {address: addr},
			success: function(res){
				initMap(res[1], res[0], addr);
				$("input[name=txt_lng]").val(res[0]);
				$("input[name=txt_lat]").val(res[1]);
			}
		});
	}
}

function loadMap(lat, lng, addr){
	initMap(lat, lng, addr);
	$("input[name=txt_lng]").val(lng);
	$("input[name=txt_lat]").val(lat);
}
