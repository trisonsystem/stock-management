<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>
<div class="row pdTop">
    <div class="widget-body" id="loadMainStock" style="">
        <div class="widget-main">
            <div class="row">
                <div class="col-xs-12 widthTable">
                    
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-2 control-label" style="max-width:85px;">ค้นหาสินค้า</label>
                            <div class="col-xs-10 col-sm-3">
                                <input type="text" id="productname" name="productname" value="" />
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <button type="button" name="search" id="search" class="btn btn-primary btn-sm" onclick="searchStock(this);">
                                        Search
                                </button>
                                <button type="button" name="add" id="add" class="btn btn-yellow btn-sm" onclick="getMenu('addStock')">
                                        Add Stock
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="tbStock" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" >ลำดับ</th>
                                    <th>สาขา</th>
                                    <th>รหัสสินค้า</th>
                                    <th >ชื่อสินค้า</th>
                                    <th >ประเภท</th>
                                    <th >หน่วยนับ</th>
                                    <th >จำนวน</th>
                                    <th >ราคาทุน</th>
                                    <th >ราคาขาย</th>
                                    <th >สถานะ</th>
                                    <th >จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="11"><center>No Data</center></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="15">
                                        Page <span class="badge badge-primary" name="pageNum">0</span> || Show <span name="listCount">0</span> Row
                                        <div class="form-group pull-right">
                                            <button type="button" class="btn btn-prev btn-sm" name="prevPage" disabled="" onclick="searchStock(this);">
                                                <i class="ace-icon fa fa-arrow-left"></i>Prev
                                            </button>
                                            <button type="button" class="btn btn-success btn-next btn-sm" disabled="" name="nextPage" onclick="searchStock(this);">
                                                Next <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <hr />
        </div>
    </div>
</div>
<script type="text/javascript">

    // 
	
	jQuery(function($) {
        //datepicker plugin
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        searchStock();
    });

    function searchStock(btnow){

        $("#loadMainStock").load('show');

        $.ajax({
            url: 'stockList',
            data: { 

                productname : $('input[name="productname"]').val(),
                pageNum     : $("#tbStock").data('pageNum'),
                limit       : 5,
                btName      : $(btnow).attr('name')
             },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                // console.log(response); 

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
                $("#loadMainStock").load('hide');
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function delStock(sid){

        // $("#loadMainProduct").load('show');
        $("button").prop("disabled",true);

        bootbox.dialog({
            message: "confirm_chk",
            buttons: {
                confirm: {
                    label: "<?php echo $this->lang->line('save') ?> ",
                    className: "btn-primary btn-sm bt_confirm",
                    callback: function(result) {

                        $.ajax({
                            url: 'delStock',
                            type: 'POST',
                            data: {id:sid},
                            dataType: 'json',
                            success: function (response) {
                                // console.log(response);
                                
                                if(response.status){
                                    $.gritter.add({
                                        title: "",
                                        text: '<h5><i class="fa fa-check" aria-hidden="true"></i> '+response.msg+'</h5>',
                                        class_name: 'gritter-success'
                                    });
                                    searchStock();
                                }else{
                                    $.gritter.add({
                                        title: "",
                                        text: '<h5><i class="fa fa-ban" aria-hidden="true"></i> '+response.msg+'</h5>',
                                        class_name: 'gritter-error'
                                    });
                                }
                                $("button").prop("disabled",false);
                                
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                        
                    }
                },
                cancel: {
                    label: "cancel",
                    className: "btn-sm",
                    callback: function(result){
                        $("button").prop("disabled",false);
                    }
                }
            }
        });

    }

	
</script>