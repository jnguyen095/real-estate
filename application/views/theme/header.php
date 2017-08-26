<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */
?>

<div class="header">
	<div class="banner">
		<div class="header-logo float-left">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="672 350 185 87"><g data-item-type="text" data-item="Business" id="logo__item--business" class="logo__item">
					<g class="logo__item__inner" transform="translate(674.3203125 409.76072858773483) scale(1 1) rotate(0 0 0)">
						<text data-part-id="logo__item--business" dy="0" dominant-baseline="auto" alignment-baseline="auto" font-family="Oswald" font-size="32px" fill="#1d9cb8" letter-spacing="0" font-weight="normal" font-style="normal" data-font-family="Oswald" data-font-weight="normal" data-font-style="normal" data-ttf-url="/builder_assets/fontsttf/font-montserrat-bold-normal.ttf" data-font-filename="oswald-normal-normal">tindatdai.com</text>
					</g>
				</g><g data-item-type="image" data-item="Image" data-logo-item="" id="logo__item--logo_0" class="logo__item">
					<g class="logo__item__inner" transform="translate(698.0324747593226 297) scale(1.3461215381551475 1.3461215381551475) rotate(0 0 0)">

						<g>
							<polygon fill="#1d30b8" points="94.321,60.736 73.409,41.923 47.424,49.765 21.339,43.264 5.176,60.738 8.693,60.738    21.339,47.414 31.463,55 33.49,54.976 33.494,56.377 26.663,60.738 52.641,60.738 73.286,44.955 90.288,60.736  " data-part-id="logo__item--logo_0__0"></polygon>
							<g>
								<polygon fill="#231F20" points="72.804,56.893 69.81,57.432 69.81,54.438 72.804,53.898" data-part-id="logo__item--logo_0__1"></polygon>
								<polygon fill="#231F20" points="76.041,56.312 73.045,56.85 73.045,53.854 76.041,53.315" data-part-id="logo__item--logo_0__2"></polygon>
								<polygon fill="#231F20" points="72.804,60.711 69.81,60.711 69.81,57.715 72.804,57.176" data-part-id="logo__item--logo_0__3"></polygon>
								<polygon fill="#231F20" points="76.041,60.667 73.045,60.667 73.045,57.133 76.041,56.593" data-part-id="logo__item--logo_0__4"></polygon>
							</g>
							<g>
								<polygon fill="#231F20" points="20.687,57.936 19.008,57.654 19.01,55.372 20.692,55.653" data-part-id="logo__item--logo_0__5"></polygon>
								<polygon fill="#231F20" points="22.501,58.24 20.823,57.959 20.826,55.675 22.505,55.958" data-part-id="logo__item--logo_0__6"></polygon>
								<polygon fill="#231F20" points="20.683,60.716 19.003,60.716 19.006,57.87 20.687,58.149" data-part-id="logo__item--logo_0__7"></polygon>
								<polygon fill="#231F20" points="22.5,60.738 20.82,60.738 20.822,58.174 22.501,58.454" data-part-id="logo__item--logo_0__8"></polygon>
							</g>
						</g>

					</g>
				</g><g data-item-type="text" id="logo__item--tagline_1" data-item="Tagline" class="logo__item">
					<g class="logo__item__inner" transform="translate(695 431) scale(1 1) rotate(0 0 0)">
						<text dy="0" dominant-baseline="auto" alignment-baseline="auto" font-family="PT Sans" font-size="18px" fill="#23527c" letter-spacing="1" data-font-family="PT Sans" data-font-weight="normal" data-font-style="normal" font-weight="normal" font-style="normal" data-ttf-url="/builder_assets/fontsttf/font-open-sans-normal-normal.ttf" data-part-id="logo__item--tagline_1__0" data-font-filename="pt-sans-normal-normal">tin bất động sản</text>
					</g>
				</g></svg>
		</div>
		<div class="header-right float-right">
			<?php
				if($this->session->userdata('username') != null){
			?>
				<div><a href="<?=base_url('/thong-tin-ca-nhan.html')?>"><?=$this->session->userdata('fullname')?></a> | <a href="<?=base_url('/quan-ly-tin-rao.html')?>">Quản lý tin rao</a> | <a href="<?=base_url('/dang-xuat.html')?>">Đăng xuất</a></div>
			<?php
				}else{
			?>
				<div><a href="<?=base_url('/dang-nhap.html')?>">Đăng nhập</a>  | <a href="<?=base_url('/dang-ky.html')?>">Đăng ký</a></div>
			<?php
				}
			?>
			<?php
			if($this->session->userdata('username') != null){
			?>
				<div class="post-btn"><a class="btn-sm btn-primary" href="<?=base_url('/dang-tin.html')?>">Đăng tin miễn phí</a></div>
			<?php }?>
		</div>
		<div class="clear-both"></div>
	</div>


	<nav class="navbar navbar-default m-navbar" data-spy="affix_" data-offset-top="67"/>
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar4">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar4" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php
					echo ' <li><a class="navbar-brand" href="'.base_url().'"><span class="glyphicon glyphicon-home"></span></a></li>';
					foreach($categories as $r) {
						if(count($child[$r->CategoryID]) > 0){
							echo '<li role="presentation" class="dropdown">
								<a  href="'.base_url().seo_url($r->CatName).'-c'.$r->CategoryID. '.html" role="button" aria-haspopup="true" aria-expanded="false">
											'.$r->CatName.' <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">';
							foreach ($child[$r->CategoryID] as $k){
								echo '<li><a href="'.base_url().seo_url($k->CatName).'-c'.$k->CategoryID. '.html">'.$k->CatName.'</a></li>';
							}

							echo '</ul></li>';
						}else{
							echo ' <li><a href="'.seo_url($r->CatName).'-c'.$r->CategoryID. '.html">'.$r->CatName.'</a></li>';
						}
					}
					?>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>
</div>
