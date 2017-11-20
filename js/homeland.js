/**
 * Created by Khang Nguyen(khang.nguyen@banvien.com) on 8/1/2017.
 */

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	loadSearchDistrictByCityId();
	submitSearchForm();
	subscribleHandler();
	$(".toggleBtn").click(function() {
		changeIconMoreLess($(this));
	});
	$("#myBtn").click(function(){
		topFunction();
	});
	bindingChangeCaptchaEvent();
	contactFormHandler();

});

function bindingChangeCaptchaEvent(){
	$("#changeCaptcha").click(function (){
		$("#captchaImg").html("<img src='/img/load.gif'/>");
		jQuery.ajax({
			type: "POST",
			url: urls.loadCaptchaUrl,
			dataType: 'json',
			success: function(res){
				$("#captchaImg").html(res[0].capchaImg);
			}
		});
	});
}

function changeIconMoreLess($this){
	if($this.data('status') == 'open'){
		$this.html('Ít hơn');
		$this.data('status','close');
		$this.removeClass('toggleMore').addClass('toggleLess');
	}else{
		$this.html('Xem thêm');
		$this.data('status','open');
		$this.removeClass('toggleLess').addClass('toggleMore');
	}
}

function subscribleHandler(){
	$("#btnSubscrible").click(function(e){
		var email = $("#sbEmail").val();
		if(email != null && isValidEmail(email)){
			ga('send', {
				hitType: 'event',
				eventCategory: 'Subscrible',
				eventAction: 'Subscrible email',
				eventLabel: 'Subscrible'
			});

			jQuery.ajax({
				type: "POST",
				url: urls.addSubscribleUrl,
				dataType: 'json',
				data: {email: email},
				success: function(res){
					if(res == 'success'){
						$("#subcribleMes").html("<span class='subscrible-success'>Đăng ký theo dõi thành công.</span>");
					}else{
						$("#subcribleMes").html("<span class='subscrible-danger'>Email này đã tồn tại.</span>");
					}
				}
			});
		}else{
			$("#subcribleMes").html("<span class='subscrible-danger'>Email không đúng định dạng.</span>");
		}
	});
}

function isValidEmail(email){
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

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

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		$("#myBtn").show(1000);
	} else {
		$("#myBtn").hide(1000);
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	ga('send', {
		hitType: 'event',
		eventCategory: 'Go to Top',
		eventAction: 'Go to Top',
		eventLabel: 'Go to Top'
	});
	$('html,body').animate({ scrollTop: 0 }, 'slow');
}

function contactFormHandler(){
	$("#contactModalForm").click(function(){
		$.ajax({
			type:'POST',
			url: urls.base_url + 'ajax_controller/contactFormHandler',
			data: null,
			success:function(msg) {
				$("#modalFormDialog").html(msg);
				var $modal = $('#modalFormDialog');
				$modal.modal('show');
				bindingChangeCaptchaEvent();

			}
		});
	});
}

function submitContactForm(){
		var dataString = $("#modalForm").serialize();
		$.ajax({
			type:'POST',
			url: urls.base_url + 'ajax_controller/contactFormHandler',
			data: dataString,
			beforeSend: function () {
				$('.submitBtn').attr("disabled","disabled");
				$('.modal-body').css('opacity', '.5');
			},
			success:function(msg){
				if(msg == "success"){
					$('#fullName').val('');
					$('#inputEmail').val('');
					$('#inputPhone').val('');
					$('#inputMessage').val('');
					$('#txtCaptcha').val('');
					$("#btnSendFeedBack").hide();
					$('.statusMsg').html('<span style="color:green;">Gửi thành công, chúng tôi sẻ phản hồi ngay khi có thể.</p>');
				}else{
					$('.statusMsg').html('<span style="color:red;">'+msg+'</span>');
				}
				$('.submitBtn').removeAttr("disabled");
				$('.modal-body').css('opacity', '');
			}
		});
}
