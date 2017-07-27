<!DOCTYPE html>
<html lang = "en">

<head>
	<meta charset = "utf-8">
	<title><?php echo $product->Title?></title>
	<?php $this->load->view('common_header')?>
</head>

<body>
<script type="text/javascript">
	jssor_1_slider_init = function() {

		var jssor_1_SlideshowTransitions = [
			{$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
			{$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
		];

		var jssor_1_options = {
			$AutoPlay: 1,
			$SlideshowOptions: {
				$Class: $JssorSlideshowRunner$,
				$Transitions: jssor_1_SlideshowTransitions,
				$TransitionsOrder: 1
			},
			$ArrowNavigatorOptions: {
				$Class: $JssorArrowNavigator$
			},
			$ThumbnailNavigatorOptions: {
				$Class: $JssorThumbnailNavigator$,
				$Cols: 5,
				$Align: 400
			}
		};

		var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

		/*#region responsive code begin*/
		/*remove responsive code if you don't want the slider scales while window resizing*/
		function ScaleSlider() {
			var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
			if (refSize) {
				refSize = Math.min(refSize, 980);
				jssor_1_slider.$ScaleWidth(refSize);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}
		ScaleSlider();
		$Jssor$.$AddEvent(window, "load", ScaleSlider);
		$Jssor$.$AddEvent(window, "resize", ScaleSlider);
		$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
		/*#endregion responsive code end*/
	};
</script>
<style>
	.jssora106 {display:block;position:absolute;cursor:pointer;}
	.jssora106 .c {fill:#fff;opacity:.3;}
	.jssora106 .a {fill:none;stroke:#000;stroke-width:350;stroke-miterlimit:10;}
	.jssora106:hover .c {opacity:.5;}
	.jssora106:hover .a {opacity:.8;}
	.jssora106.jssora106dn .c {opacity:.2;}
	.jssora106.jssora106dn .a {opacity:1;}
	.jssora106.jssora106ds {opacity:.3;pointer-events:none;}

	.jssort051 .p {position:absolute;top:0;left:0;background-color:#000;}
	.jssort051 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.45;}
	.jssort051 .p:hover .t{opacity:.8;}
	.jssort051 .pav .t, .jssort051 .pdn .t, .jssort051 .p:hover.pdn .t{opacity:1;}
</style>
<div class="container">
<?php $this->load->view('/theme/header')?>

<ul class="breadcrumb">
	<?php
		if(isset($category->Parent)){
			echo '<li><a href="'.base_url().seo_url($category->Parent->CatName).'-c'.$category->Parent->CategoryID.'.html">'.$category->Parent->CatName.'</a></li>';
		}
	?>
	<li><a href="<?php echo base_url().seo_url($category->CatName).'-c'.$category->CategoryID?>.html"><?php echo $category->CatName?></a></li>
	<li class="active"><?php echo $product->Title?></li>
</ul>
<div class="row no-margin">
	<div class="col-md-9  no-margin no-padding">
		<div class="product-title"><?php echo $product->Title?></div>
		<div>Khu vực: <span class="color bold">
			<?php
				if(isset($product->Street)){
					echo $product->Street->StreetName;
				}
				if(isset($product->Ward)){
					echo ' - ';
					echo $product->Ward->WardName;
				}
				if(isset($product->District)){
					echo ' - ';
					echo $product->District->DistrictName;
				}
				if(isset($product->City)){
					echo ' - ';
					echo $product->City->CityName;
				}
			?>
		</span></div>
		<div>Giá: <span class="color bold"><?php echo $product->PriceString?></span><span class="margin-left-10">Diện tích: <span class="color bold"><?php echo $product->Area?></span></span></div>
		<div class="product-detail"><?php echo $product->Detail?></div>

		<div class="product-assets">
			<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:743px;height:480px;overflow:hidden;visibility:hidden;">
				<!-- Loading Screen -->
				<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url(<?php echo base_url('img/loading.gif')?> no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
				<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:743px;height:380px;overflow:hidden;">
					<?php
						foreach($product->Assets as $asset){
							echo '<div>';
							echo '<img data-u="image" src="'.str_replace('resize/200x200/','', $asset->OrgUrl).'" />';
							echo '<img data-u="thumb" src="'.$asset->Url.'" />';
							echo '</div>';
						}
					?>
					<a data-u="any" href="https://www.jssor.com" style="display:none">bootstrap slider</a>
				</div>
				<!-- Thumbnail Navigator -->
				<div data-u="thumbnavigator" class="jssort051" style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;" data-autocenter="1" data-scale-bottom="0.75">
					<div data-u="slides">
						<div data-u="prototype" class="p" style="width:200px;height:100px;">
							<div data-u="thumbnailtemplate" class="t"></div>
						</div>
					</div>
				</div>
				<!-- Arrow Navigator -->
				<div data-u="arrowleft" class="jssora106" style="width:55px;height:55px;top:162px;left:30px;" data-scale="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
						<polyline class="a" points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
						<line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
					</svg>
				</div>
				<div data-u="arrowright" class="jssora106" style="width:55px;height:55px;top:162px;right:30px;" data-scale="0.75">
					<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
						<circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
						<polyline class="a" points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
						<line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
					</svg>
				</div>
			</div>
			<script type="text/javascript">jssor_1_slider_init();</script>
		</div>
	</div>
	<div class="col-md-3 no-margin-right no-padding-right">
		<?php $this->load->view('/Search_filter') ?>
	</div>


</div>


<?php $this->load->view('/theme/footer')?>
</div>
</body>

</html>
