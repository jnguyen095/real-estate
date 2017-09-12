/**
 * Created by Ban Vien on 8/1/2017.
 */

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	loadSearchDistrictByCityId();
	submitSearchForm();
});

function loadSearchDistrictByCityId(){
	$("#cmCityId").change(function(){
		var cityId = $(this).val();
		jQuery.ajax({
			type: "POST",
			url: urls.loadDistrictByCityId,
			dataType: 'json',
			data: {cityId: cityId},
			success: function(res){
				document.getElementById("cmDistrictId").options.length = 1;
				for(key in res){
					$("#cmDistrictId").append("<option value='"+res[key].DistrictID+"'>"+res[key].DistrictName+"</option>");
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

function submitSearchForm(){
	$("#btnSearch").click(function(){
		ga('send', {
			hitType: 'event',
			eventCategory: 'Search',
			eventAction: 'Tìm kiếm',
			eventLabel: 'Tìm kiếm'
		});
		$("form#search_form").submit();
	});
}
