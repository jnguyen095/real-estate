
<div class="subscribe-panel col-md-12 no-padding">
	<div>
		<div class="postStatus">
			<?php
			if($product->Status == 1){
				echo '<span class="active">Đang bán!</span>';
			}else{
				echo '<span class="inactive">Hết giao dịch</span>';
			}
			?>
		</div>
		<div class="facebookShare">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=263683937369914";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>

			<!-- Your share button code -->
			<div class="fb-share-button"
				 data-href="<?=base_url($_SERVER['REQUEST_URI'])?>"
				 data-size="large"
				 data-layout="button">
			</div>
		</div>
		<div class="googleShare">
			<!-- Place this tag where you want the share button to render. -->
			<div class="g-plus" data-action="share" data-height="32"></div>
		</div>
		<div class="clear-both"></div>
	</div>
</div>
