<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/3/2017
 * Time: 10:04 AM
 */
?>
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url('/admin/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$this->session->userdata('fullname')?></p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- search form (Optional) -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
			</div>
		</form>
		<!-- /.search form -->

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">HEADER</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="active"><a href="<?=base_url('/admin/dashboard.html')?>"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
			<li><a href="<?=base_url('/admin/user/list.html')?>"><i class="fa fa-link"></i> <span>Người dùng</span></a></li>
			<li><a href="<?=base_url('/admin/purchase-history/list.html')?>"><i class="fa fa-link"></i> <span>Giao dịch</span></a></li>
			<li><a href="<?=base_url('/admin/static-page/list.html')?>"><i class="fa fa-link"></i> <span>Trang tĩnh</span></a></li>
			<li><a href="<?=base_url('/admin/product/list.html')?>"><i class="fa fa-link"></i> <span>Bài đăng</span></a></li>
			<li><a href="<?=base_url('/admin/cooperate/list.html')?>"><i class="fa fa-link"></i> <span>Hợp tác</span></a></li>
			<li><a href="<?=base_url('/admin/feedback/list.html')?>"><i class="fa fa-link"></i> <span>Phản hồi</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
					<span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#">Link in level 2</a></li>
					<li><a href="#">Link in level 2</a></li>
				</ul>
			</li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
