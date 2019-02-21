<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>
<div class="row pdTop">
    <div class="widget-body" id="loadMainProduct">
        <div class="widget-main">

            <div class="row">
                <div class="col-xs-12 widthTable">
                    
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-2 control-label " >ชื่อสินค้า</label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="text" id="productname" name="productname" value="" />
                            </div>
                            <label class="col-xs-12 col-sm-2 control-label " >วันที่เอกสาร</label>
                            <div class="col-xs-12 col-sm-3">
                                <div class="input-group">
                                    <input class="form-control date-picker" id="sdate" name="sdate" type="text" data-date-format="dd-mm-yyyy" value="" readonly="readonly" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <button type="button" name="search" id="search" class="btn btn-primary btn-sm" onclick="searchProduct(this);">
                                        Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="tbProduct" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" >ลำดับ</th>
                                    <th>รหัสสินค้า</th>
                                    <th >ชื่อสินค้า</th>
                                    <th >หน่วยนับ</th>
                                    <th >จำนวน</th>
                                    <th >ตุ้นทุน/หนวย</th>
                                    <th >ราคา/หนวย</th>
                                    <th >จำนวนเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="10"><center>No Data</center></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="15">
                                        Page <span class="badge badge-primary" name="pageNum">0</span> || Show <span name="listCount">0</span> Row
                                        <div class="form-group pull-right">
                                            <button type="button" class="btn btn-prev btn-sm" name="prevPage" disabled="" onclick="searchProduct(this);">
                                                <i class="ace-icon fa fa-arrow-left"></i>Prev
                                            </button>
                                            
                                            <button type="button" class="btn btn-success btn-next btn-sm" disabled="" name="nextPage" onclick="searchProduct(this);">
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
    });

    function searchProduct(btnow){

        $("#loadMainProduct").load('show');

        $.ajax({
            url: 'productList',
            data: { 

                productname : $('input[name="productname"]').val(),
                pageNum     : $("#tbProduct").data('pageNum'),
                btName      : $(btnow).attr('name')
             },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                // console.log(response);

                if(response.status){

                    $("#tbProduct tbody").html(response.list);
                    $("#tbProduct").data('pageNum',response.optionPage.page);
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
                $("#loadMainProduct").load('hide');
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

	
</script>