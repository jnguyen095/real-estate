<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/19/2017
 * Time: 11:17 AM
 */
?>
<div class="header">
	<div class="header-logo"></div>

	<nav class="navbar navbar-default m-navbar" data-spy="affix" data-offset-top="67">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar4">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<a class="navbar-brand" href="<?php echo base_url() ?>"><span class="glyphicon glyphicon-home"></span></a>
			<div id="navbar4" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php
					foreach($categories as $r) {
						if(count($child[$r->CategoryID]) > 0){
							echo '<li role="presentation" class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="'.base_url().'category/'.$r->CategoryID. '.html" role="button" aria-haspopup="true" aria-expanded="false">
											'.$r->CatName.' <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">';
							foreach ($child[$r->CategoryID] as $k){
								echo '<li><a href="'.base_url().'category/'.$k->CategoryID. '.html">'.$k->CatName.'</a></li>';
							}

							echo '</ul></li>';
						}else{
							echo ' <li class="active"><a href="'.base_url().'category/'.$r->CategoryID. '.html">'.$r->CatName.'</a></li>';
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
