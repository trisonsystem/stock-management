<?php 
  $path_assets = base_url()."assets/"; 
  $path_host  = $this->config->config['base_url'];
?>

<div class="title_page">
	<h1><?php echo $title;?></h1>
  <?php // debug($listData, true); ?>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="box-search">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
          <span>เลขที่ใบนำเข้าสินค้า : </span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <input type="text" id="stxtDocument_no" class="form-control" name="stxtDocument_no">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
          <span>วันที่ใบนำเข้าสินค้า : </span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <input class="form-control stxtDocument_date" placeholder="Select date" type="text" id="stxtDocument_date" name="stxtDocument_date">
        </div>
      </div>
      <div class="row" style="margin-top: 5px">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
          <span>เลขที่ใบอ้างอิง : </span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <input type="text" id="stxtRefer_no" class="form-control" name="stxtRefer_no">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
          <span><?php echo $this->lang->line('distributor'); ?> : </span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <input type="hidden" class="form-control" id="stxtDistributor_id" name="stxtDistributor_id"  value="" />
          <input type="text" class="form-control" id="stxtDistributor_name" name="stxtDistributor_name" value="" />
        </div>
      </div>
      <div class="row" style="margin-top: 5px">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
          <span>สถานะ : </span>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <select id="stxtDocument_status" name="stxtDocument_status" class="form-control">
            <option value=""> -- <?php echo $this->lang->line('select_status'); ?> -- </option>
            <option value="0">กำลังสร้าง</option>
            <option value="1">อนุมัติ</option>
            <!-- <option value="2">กำลังสร้าง</option> -->
            <option value="99">ยกเลิก</option>
          </select>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
          <button type="button" name="search" id="search" class="btn btn-primary btn-sm" onclick="searchImportorder(this);"><?php echo $this->lang->line('search'); ?></button>
          <button type="button" name="add" id="add" class="btn btn-yellow btn-sm" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
          <button type="button" name="add" id="add" class="btn btn-success btn-sm" onclick="getMenu('manage_importorder/index');"><?php echo $this->lang->line('add'); ?></button>
        </div>
      </div>
    </div>    
    <div class="table-responsive" style="margin-top: 30px">
  		<table class="table table-striped table-bordered table-hover" id="tb-ipo-list">
  			<thead>
  				<tr>
  					<th>ลำดับ</th>
  					<th>เลขที่ใบเสนอสินค้า</th>
  					<th>วันที่เอกสาร</th>
            <th><?php echo $this->lang->line('distributor'); ?></th>
            <th>เลขที่อ้างอิง</th>
  					<th>สถานะ</th>
  					<th>ผู้สร้าง</th>
            <th>remark</th>
  					<th>วันที่สร้าง</th>
  					<th>พิมพ์</th>
  					<th>อนุมัติ</th>
  					<th>จัดการ</th>
  				</tr>
  			</thead>
  			<tbody></tbody>
        <tfoot>
            <tr>
                <td colspan="15">
                    Page <span class="badge badge-primary" name="pageNum">0</span> || Show <span name="listCount">0</span> Row
                    <div class="form-group pull-right">
                        <button type="button" class="btn btn-prev btn-sm" name="prevPage" disabled="" onclick="searchProductType(this);">
                            <i class="ace-icon fa fa-arrow-left"></i>Prev
                        </button>
                        <button type="button" class="btn btn-success btn-next btn-sm" disabled="" name="nextPage" onclick="searchProductType(this);">
                            Next <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tfoot>
  		</table>
      <div class="filter_remark" id="filter_remark"></div>
    </div>
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

<!-- Modal -->
  <div class="modal fade" id="myModalfilter" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal_content" id="modal_content"></div>
      </div>
      
    </div>
  </div>

<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Quotation.css">

<script type="text/javascript">
  $(document).ready(function() {
    searchImportorder();
    ddatepicker();
  });

  function searchImportorder(btnow){  
    var option = {
      doc_id          : "",
      doc_no          : $('#stxtDocument_no').val(),
      doc_date        : $("#stxtDocument_date").val(),
      refer_no        : $("#stxtRefer_no").val(),
      distributor_id  : $("#stxtDistributor_id").val(),
      status          : $("#stxtDocument_status").val(),
      pageNum         : $("#tb-ipo-list").data('pageNum'),
      btName          : $(btnow).attr('name')
    }

    $("#stxtDistributor_name").autocomplete({
        source:'<?php echo $path_host; ?>autoc/distributor',
        select: function( event, ui ) {
            console.log(ui);
            event.preventDefault();
            $("#stxtDistributor_name").val(ui.item.value.name);
            $("#stxtDistributor_id").val(ui.item.value.id);
        }
    });

    $.get("manage_importorder/get_importorder_list", option, function( aData ){
      aData = jQuery.parseJSON( aData );
      
      var str_html  = "";
      // console.log(aData.status_flag);

      if (aData.status_flag != 0) {
        $.each(aData['data'], function(k , v){
          var status = "";
          switch (v.status) {
            case '0': status = '<span style="color:#000;">กำลังสร้าง</span>';break;
            case '1': status = '<span style="color:blue;">อนุมัติ</span>';break;
            // case '2': status = '<span style="color:#cc8b0d;">ยกเลิกรอการแก้ไข</span>';break;
            // case '3': status = '<span style="color:green;">แก้ไขรอการอนุมัติ</span>';break;
            case '99': status = '<span style="color:red;">ยกเลิก</span>';break;
          }

          str_html += "<tr>";
          str_html += " <td>"+( parseInt(k)+1 )+"</td>"; 
          str_html += " <td>"+v.order_no+"</td>";  
          str_html += " <td>"+v.order_date+"</td>";
          str_html += " <td>"+v.distri_name+"</td>"; 
          str_html += " <td>"+v.order_refer+"</td>";
          str_html += " <td>"+status+"</td>";
          str_html += " <td>"+v.remark+"</td>"; 
          str_html += " <td>"+v.create_by+"</td>"; 
          str_html += " <td>"+v.create_date+"</td>"; 
          str_html += " <td align='center'><i class='fa fa-print' style='font-size:20px' onclick='export_to_pdf("+v.id+")'></i></td>"; 
          str_html += " <td align='center'>";
          if( v.status == "0" ){
            str_html += "   <i class='fa fa-check-circle' style='font-size:20px' onclick='approve("+v.id+")'></i>";
            str_html += "   <i class='fa fa-exclamation-circle' style='font-size:20px' onclick='no_approve("+v.id+")'></i>";
          }
          str_html += " </td>"; 
          str_html += " <td align='center'>";
          str_html += "   <i class='fa fa-edit' style='font-size:20px' onclick='edit_importorder("+v.id+")'></i>";
          str_html += "   <i class='fa fa-remove' style='font-size:20px' onclick='delete_quotation("+v.id+")'></i>";
          str_html += " </td>";        
          str_html += "</tr>";
        });
      }else{
        str_html += "<td colspan='10' class='text-center' style='color:red;margin-top:15px;'> <?php echo $this->lang->line('no_data'); ?> </td>";
      }
      
      var re_html = "";
      if (aData['status']) {
        $("#tb-ipo-list tbody").html( str_html );
        $("#tb-ipo-list").data('pageNum',aData['optionPage'].page);
        $('span[name="pageNum"]').text(aData['optionPage'].page);
        $('span[name="listCount"]').text(aData['optionPage'].listCount);

        if(aData['optionPage'].listCount == 15){
          $('button[name="prevPage"]').attr('disabled',false);
        }else{
          $('button[name="prevPage"]').attr('disabled',true);
        }

        if(aData['optionPage'].page != 1){
          $('button[name="prevPage"]').attr('disabled',false);
        }else{
          $('button[name="prevPage"]').attr('disabled',true);
        }
        
      }else{
        dialogError('data error');
        clear_data();
      }
      
    });

  }

  function ddatepicker(){
    $(".stxtDocument_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        // startDate: new Date(),
    });
  }

  function clear_data(){
    $("input").val("");
    $("select").val("");
    $("textarea").val("");
  }

  function approve(id){
    $.post("manage_importorder/approve",  { doc_id : id } ,function( res ){
      res = jQuery.parseJSON( res ); 
      
      if (res.status) {
        alert( res.msg );
        searchImportorder();
      }else{
        alert( res.msg );
      }
    });
  }

  function no_approve(id){
    $("#btn-save-noapprove").attr("data", id);
    $("#md-title-no-approve").html("<span style='color:red;'>ไม่อนุมัติเพาะ</span>");
    $("#txt-no-approve").html("");
    $("#md-no-approve").modal("show");
    
  }

  function save_noapprove(){
    var doc_id = $("#btn-save-noapprove").attr("data");
    var remark = $('#txt-no-approve').val();
    $.post("manage_importorder/no_approve",  { doc_id : doc_id, remark : remark } ,function( res ){
      res = jQuery.parseJSON( res ); 
      console.log(res);
      if (res.status) {
        alert( res.msg );
        $("#md-no-approve").modal("toggle");
        searchImportorder();
      }else{
        alert( res.msg );
      }

    });
  }

  function edit_importorder(id){
    getMenu('manage_importorder/edit_importOrder/' + id);
  }

</script>