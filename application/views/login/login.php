<!DOCTYPE html>
<html>
<head>
	<head>
		<meta charset = "utf-8">
		<title>Tin Đất Đai - Đăng Nhập</title>
		<?php $this->load->view('common_header')?>
		<?php $this->load->view('/common/googleadsense')?>
	</head>
</head>
<body>
<?php $this->load->view('/common/analyticstracking')?>
<div class="container">
	<?php $this->load->view('/theme/header')?>

	<div class="row no-margin">
		<div class="col-lg-6 col-lg-offset-3 col-sm-6 well login-panel">
			<?php
				$attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
				echo form_open("dang-nhap", $attributes);
			?>
			<fieldset>
				<legend class="text-center">ĐĂNG NHẬP</legend>
				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_username" class="control-label">Tên đăng nhập</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_username'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row colbox no-margin">
						<div class="col-lg-4 col-sm-4">
							<label for="txt_password" class="control-label">Mật khẩu</label>
						</div>
						<div class="col-lg-8 col-sm-8">
							<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" />
							<span class="text-danger"><?php echo form_error('txt_password'); ?></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-8 col-sm-8 col-lg-offset-4 text-left">
						<input type="hidden" name="crudaction" value="Login"/>
						<input id="btn_login" name="btn_login" type="submit" class="btn btn-info" value="Đăng nhập" />
					</div>
				</div>

				<legend class="text-center">Hoặc</legend>

				<div class="form-group">
					<div class="social-login-buttons text-center">

						<?php $this->load->view('/FacebookID'); ?>
						<a id="loginBtnFacebook" class="loginBtn loginBtn--facebook" >
							Đăng nhập bằng Facebook
						</a>

						<?php $this->load->view('/GoogleID'); ?>
						<a id="loginBtnGoogle" class="loginBtn loginBtn--google">
							Đăng nhập bằng Google
						</a>

					</div>
				</div>

				<legend class="text-center">Chưa có tài khoản?</legend>
				<div class="form-group">
					<div class="social-login-buttons">
						Đăng ký tại đây: <a href="<?=base_url('dang-ky.html')?>" class="btn btn-primary"><i class="glyphicon glyphicon-registration-mark"></i> Đăng ký</a> để đăng tin miễn phí và theo dõi phản hồi từ khách hàng.
					</div>
				</div>

			</fieldset>
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
	</div>
	<script type="text/javascript">
		var loginServerCallback = function(res){
			if(res.success){
				window.location.href = '<?=base_url('/trang-chu.html')?>';
			}
		}

		function checkFacebookLoginState() {
			FB.login(function(response) {
				if (response.status == 'connected') {
					var accessToken = response.authResponse.accessToken;
					var userID = response.authResponse.userID;
					FB.api('/me?fields=email,name,picture', function(response) {
						var email = response.email;
						var fullName = response.name;
						socialLogin(email, userID, fullName, loginServerCallback);
					});
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}
			}, {scope: 'email,public_profile'});
		}

		function googleLoginCallback(result)
		{
			if(result['status']['signed_in'])
			{
				var request = gapi.client.plus.people.get({
					'userId': 'me'
				});
				request.execute(function(resp) {
					var email = '';
					if(resp['emails'])
					{
						for(i = 0; i < resp['emails'].length; i++)
						{
							if(resp['emails'][i]['type'] == 'account')
							{
								email = resp['emails'][i]['value'];
							}
						}
					}

					var fullName = resp['displayName'];
					var email = email;
					var userID = resp['id'];
					socialLogin(email, userID, fullName, loginServerCallback);
				});
			}
		}

		function checkGoogleLoginState(){
			var myParams = {
				'clientid' : '<?=GOOGLE_ID?>',
				'cookiepolicy' : 'single_host_origin',
				'callback' : 'googleLoginCallback',
				'approvalprompt':'force',
				'scope' : 'profile email',
				'fetch_basic_profile': true
			};

			gapi.auth.signIn(myParams);
		}

		$(document).ready(function(){
			$("#loginBtnFacebook").click(function(){
				checkFacebookLoginState();
			})

			$("#loginBtnGoogle").click(function(){
				checkGoogleLoginState();
			});
		});
	</script>

	<?php $this->load->view('/theme/footer')?>
</div>

</body>
</html>
