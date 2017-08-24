/**
 * Created by Ban Vien on 8/1/2017.
 */

$(document).ready(function(){
	uploadMultipleImages();
	loadDistrictByCityId();
	loadWardByDistrictId();
	autoComplete();
});

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
						if (data != null && data.length > 0) {
							var json = $.parseJSON(data);
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
			}
		});
	});
}

function loadDistrictByCityId(){
	$("#txtCity").change(function(){
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

			}
		});
	});
}

function socialLogin(email, userID, fullName, callback){
	jQuery.ajax({
		type: "POST",
		url: urls.social_login_url,
		dataType: 'json',
		data: {username: email, password: userID, fullname: fullName},
		success: callback
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
					$('.finish-upload .finish-text').show();
					$('.finish-upload .loadUploadOthers').hide();
					reloadOthersImagesContainer();
					$('#modalMoreImages').modal('hide');
					document.getElementById("uploadImagesForm").reset();
				}
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
