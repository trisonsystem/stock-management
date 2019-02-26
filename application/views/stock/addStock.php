<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];

    $data['id']             = (!empty($id))? $id : '';
    $data['barcode']        = (!empty($code))? $code : '';
    $data['productName']    = (!empty($name))? $name : '';
    $data['typeId']         = (!empty($type_id))? $type_id : '';
    $data['unitId']         = (!empty($unit_id))? $unit_id : '';

    // debug($data,true);
?>
<div class="page-content loadpage">
    <div class="page-header">
        <h1>
            เพิ่มสินค้า
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                สินค้าที่จะใช้ในสต๊อกทั้งหมด
            </small>
        </h1>
    </div>
    <form class="form-horizontal" id="frmAddProduct" action="" method="post">
        <div class="row">
            <div class="col-xs-6">
                <!-- <form class="form-horizontal" id="frmAddProduct" action="" method="post"> -->
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">สาขา</label>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                            <select class="form-control" id="producttype" name="producttype">
                                <option value="1">สำนักงานใหญ่</option>
                                <option value="1">xxxxxxxxxxxx</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">สินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" id="productname" name="productname" class="col-xs-12 col-sm-12" value="<?php echo $data['productName']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">ราคา</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="xxx" name="xx" class="col-xs-12 col-sm-12" value="" placeholder="ต้นทุน"/>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="xxx" name="xx" class="col-xs-12 col-sm-12" value="" placeholder="ขาย"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">จำนวน</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="xxx" name="xx" class="col-xs-12 col-sm-12" value="" />
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label">xxxxxx</label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" onclick="saveProduct();">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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

    $("#product").autocomplete({
        source:'<?php echo $path_host; ?>autoc/product',
        // source:availableTags,
        select: function( event, ui ) {
            console.log(ui);
            event.preventDefault();
            $("#product").val('');
            // addProductOrder(ui.item.value);
        }
    });


    function saveProduct(type){

        $("#pageContent").load('show');

        var serializeFrm = $("form").serializeArray();

        $.ajax({
            url: 'saveProduct',
            type: 'POST',
            data: serializeFrm,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $("#pageContent").load('hide');
                
                if(response.status){
                    $.gritter.add({
                        title: "",
                        text: '<h5><i class="fa fa-check" aria-hidden="true"></i> '+response.msg+'</h5>',
                        class_name: 'gritter-success'
                    });
                    getMenu('product');
                }else{
                    $.gritter.add({
                        title: "",
                        text: '<h5><i class="fa fa-ban" aria-hidden="true"></i> '+response.msg+'</h5>',
                        class_name: 'gritter-error'
                    });
                }
                
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

	
</script>