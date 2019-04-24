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
					<th>เลขที่ใบเสนอสินค้า</th>
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

<div class="modal" tabindex="-1" role="dialog" id="md-pd-list">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-quotation-title"></h5>
      </div>
      <div class="modal-body" id="md-pd-list-body">
      		<div class="row">
      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
      			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: right;">วันที่ : <span id="sp_datecreate"></span></div>
      		</div>
         	<table class="table" id="tb-pd-list">
         		<thead>
				<tr>
					<th>ลำดับ</th>
					<th>สินค้า</th>
					<th>จำนวน</th>
				</tr>
			</thead>
			<tbody></tbody>
         	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="md-no-approve">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title-no-approve"></h5>
      </div>
      <div class="modal-body" >
         	<textarea id="txt-no-approve" style="  height: 150px;  width: 100%;"></textarea>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-success" id="btn-save-noapprove" onclick="save_noapprove()">บันทึก</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">

<script type="text/javascript">
  $(document).ready(function() {
    searchImportorder();
  });

  function searchImportorder(btnow){
    
        // $("#loadMainProductType").load('show');

        $.ajax({
            url: 'manage_importorder/importorder_list',
            data: {
                unit_name : $('input[name="unitname"]').val(),
                pageNum     : $("#tbStock").data('pageNum'),
                // limit       : 5,
                btName      : $(btnow).attr('name')
             },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response); 

                if(response.status){

                    $("#tbStock tbody").html(response.list);
                    $("#tbStock").data('pageNum',response.optionPage.page);
                    $('span[name="pageNum"]').text(response.optionPage.page);
                    $('span[name="listCount"]').text(response.optionPage.listCount);
                    
                    if(response.optionPage.listCount == 5){
                        $('button[name="nextPage"]').attr('disabled',false);
                    }else{
                        $('button[name="nextPage"]').attr('disabled',true);
                    }

                    if(response.optionPage.page != 1){
                        $('button[name="prevPage"]').attr('disabled',false);
                    }else{
                        $('button[name="prevPage"]').attr('disabled',true);
                    }

                }else{
                    dialogError('data error');
                }
                $("#loadMainProductType").load('hide');
            },
            error: function (response) {
                console.log(response);
            }
        });
  }

</script>