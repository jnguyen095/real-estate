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
			<img src="<?=base_url('/img/logo.jpg')?>" alt="Logo"/>
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
					<li role="presentation"><a href="<?=base_url('tin-tuc.html')?>">Tin Tức</a> </li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>
</div>
