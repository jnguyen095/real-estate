
<div class="subscribe-panel col-md-12 no-padding mobile-hide">
	<div>
		<div class="facebookShare">
			<div id="fb-root"></div>
			<?php $this->load->view('/FacebookID'); ?>

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
<div class="clear-both"></div>
