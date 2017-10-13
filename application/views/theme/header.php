<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */
?>


<nav class="navbar navbar-default m-navbar navbar-fixed-top"/>
	<div class="container">
		<a class="navbar-brand brandName" href="<?=base_url('/')?>">
			<img src="<?=base_url('/img/logo1.png')?>" atl="Tin Dat Dai Logo"/>
		</a>
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
				<li role="presentation"><a href="<?=base_url('nha-mau-dep.html')?>">Nhà Mẫu Đẹp</a> </li>
				<li role="presentation"><a href="<?=base_url('tin-tuc.html')?>">Tin Tức</a> </li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
				if($this->session->userdata('username') != null){
					?>
					<li role="presentation" class="dropdown">
						<a href="<?=base_url('/thong-tin-ca-nhan.html')?>" role="button" aria-haspopup="true" aria-expanded="false">
							<?=$this->session->userdata('fullname')?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<?php
							if($this->session->userdata('usergroup') != null && $this->session->userdata('usergroup') == 'ADMIN') {
								?>
								<li><a href="<?= base_url('/admin/dashboard.html') ?>">Quản trị</a></li>
								<?php
							}
							?>
							<li><a href="<?= base_url('/quan-ly-tin-rao.html') ?>">Quản lý tin rao</a></li>
							<li><a href="<?=base_url('/dang-xuat.html')?>">Đăng xuất</a></li>
						</ul>
					</li>

					<?php
				}else{
					?>
					<li><a href="<?=base_url('/dang-nhap.html')?>">Đăng nhập</a></li>
					<?php
				}
				?>
				<li><a href="<?=base_url('/dang-tin.html')?>">Đăng tin miễn phí</a></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
	<!--/.container-fluid -->
</nav>
