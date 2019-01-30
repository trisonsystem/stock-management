<?php $path_assets = base_url()."assets/"; ?>
<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table class="table" id="tb-quo-list">
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>รหัส</th>
					<th>สินค้า</th>
					<th>สถานะ</th>
					<th>ผู้สร้าง</th>
					<th>วันที่สร้าง</th>
					<th>พิมพ์</th>
					<th>อนุมัติ</th>
					<th>จัดการ</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">
<script type="text/javascript">
	$(document).ready(function() {
		get_data_list();
	});

	function get_data_list(){
		$.get("manage_quotation/get_quotation_list",{},function( aData ){
			aData = jQuery.parseJSON( aData );
			var str_html  = ""; 
			$.each(aData, function(k , v){
			var status = "";
			switch (v.status) {
				case '0': status = 'กำลังสร้าง';break;
				case '1': status = 'อนุมัติ';break;
				case '2': status = 'ยกเลิกรอการแก้ไข';break;
				case '3': status = 'แก้ไขรอการอนุมัติ';break;
				case '99': status = 'ยกเลิก';break;
			}
				str_html += "<tr>"; 
				str_html += " <td>"+( k+1 )+"</td>"; 
				str_html += " <td>"+v.id+"</td>"; 
				str_html += " <td><a onclick='open_detail_pd("+v.id+")'>ดูสินค้าที่สั่ง</td>"; 
				str_html += " <td>"+status+"</td>";
				str_html += " <td>"+v.create_by+"</td>";  
				str_html += " <td>"+v.create_date+"</td>"; 
				str_html += " <td align='center'><i class='fa fa-print' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i></td>"; 
				str_html += " <td align='center'>";
				str_html += " 	<i class='fa fa-check-circle' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i>";
				str_html += " 	<i class='fa fa-exclamation-circle' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i>";
				str_html += " </td>"; 	
				str_html += " <td align='center'>";
				str_html += " 	<i class='fa fa-edit' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i>";
				str_html += " 	<i class='fa fa-remove' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i>";
				str_html += " </td>"; 	
				str_html += "</tr>"; 
			});
			$("#tb-quo-list tbody").html( str_html );
			console.log( aData );
		});
	}

	function open_detail_pd(id){
		alert(id);
	}

	function export_to_pdf(id){
		alert(id);
	}
</script>
