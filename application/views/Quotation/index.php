<?php
	 $path_assets = base_url()."assets/";
?>

<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">เลือกสินค้า</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php 
			foreach ($product as $key => $pd) {
				$box_pd  = "";
				$box_pd .= '<div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">';
				$box_pd .= '		<div class="box-pd-list"> <span>'.$pd['name'].'</span></div>';
				$box_pd .= '</div>';
				echo $box_pd;
			} 
		?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">