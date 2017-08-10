/**
 * Created by Ban Vien on 8/1/2017.
 */

function socialLogin(email, userID, fullName, callback){
	jQuery.ajax({
		type: "POST",
		url: urls.social_login_url,
		dataType: 'json',
		data: {username: email, password: userID, fullname: fullName},
		success: callback
	});
}

$(document).ready(function(){
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
				$('.finish-upload .finish-text').show();
				$('.finish-upload .loadUploadOthers').hide();
				reloadOthersImagesContainer();
				$('#modalMoreImages').modal('hide');
				document.getElementById("uploadImagesForm").reset();
			}
		});
	});
});



function reloadOthersImagesContainer() {
	$('.others-images-container').empty();
	$('.others-images-container').load(urls.loadOthersImages, {"txt_folder": $('[name="folder"]').val()});
}
