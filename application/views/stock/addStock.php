<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];

    $data['id']             = (!empty($id))? $id : '';
    $data['branch_id']      = (!empty($branch_id))? $branch_id : '';
    $data['product_id']     = (!empty($product_id))? $product_id : '';
    $data['product_name']   = (!empty($product_name))? $product_name : '';
    $data['amount']         = (!empty($amount))? $amount : '';
    $data['price']          = (!empty($price))? $price : '';
    $data['sell']           = (!empty($sell))? $sell : '';
    $data['remake_stock']   = (!empty($remake_stock))? $remake_stock : '';

    // debug($data,true);
?>
<div class="page-content loadpage">
    <div class="page-header">
        <h1>
            <?php if($data['id'] == ''): ?>
                เพิ่มสต๊อกสินค้า
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    สินค้าที่จะใช้ในสต๊อกทั้งหมด
                </small>
            <?php else: ?>
                แก้ไขสต๊อกสินค้า
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    สต๊อกสิ้นค้าทั้งหมด
                </small>
            <?php endif; ?>
        </h1>
    </div>
    <form class="form-horizontal" id="frmAddProduct" action="" method="post">
        <div class="row">
            <div class="col-xs-6">
                    <input type="hidden" name="stockid" value="<?php echo $data['id']; ?>">
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">สาขา</label>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                            <select class="form-control" id="productbranch" name="productbranch">
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
                            <input type="hidden" id="productid" name="productid" value="<?php echo $data['product_id']; ?>">
                            <input type="text" id="productname" name="productname" class="col-xs-12 col-sm-12" value="<?php echo $data['product_name']; ?>" <?php if($data['id'] !=''){ echo 'readonly';} ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">ราคา</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="productprice" name="productprice" class="col-xs-12 col-sm-12" value="<?php echo $data['price']; ?>" placeholder="ต้นทุน"/>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="productsell" name="productsell" class="col-xs-12 col-sm-12" value="<?php echo $data['sell']; ?>" placeholder="ขาย"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">จำนวน</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="productamount" name="productamount" class="col-xs-12 col-sm-12" value="<?php echo $data['amount']; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">หมายเหตุ</label>
                        </div>
                        <div class="col-xs-6 col-sm-8">
                            <textarea name="remake" id="remake"><?php echo $data['remake_stock']; ?></textarea>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="col-xs-6">
                <div class="form-group" id="detailproduct"  style="<?php if($data['id'] ==''){ echo 'display:none;'; } ?>">
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">รหัสสินค้า :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbBarcode">
                            <?php echo (!empty($code))? $code : ''; ?>
                        </label>
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">ชื่อสินค้า :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbProdcutname">
                            <?php echo (!empty($product_name))? $product_name : ''; ?>
                        </label>
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">หมายเหตุ :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbRemake">
                            <?php echo (!empty($remake_product))? $remake_product : ''; ?>
                        </label>
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">สถานะ :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbStatus">
                            <?php echo (!empty($status_product))? $status_product : ''; ?>
                        </label>
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">ประเภท :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbType">
                            <?php echo (!empty($type_id))? $type_id : ''; ?>
                        </label>
                    </div>
                    <div class="col-xs-6 col-sm-12">
                        <label class="control-label col-xs-3 col-sm-3">หน่วยนับ :</label>
                        <label class="control-label col-xs-6 col-sm-6" id="lbUnit">
                            <?php echo (!empty($unit_id))? $unit_id : ''; ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" onclick="saveStock();">
                            <i class="ace-icon fa fa-check bigger-110"></i>Submit
                        </button>&nbsp;
                        <button class="btn btn-danger" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>Reset
                        </button>&nbsp;
                        <button class="btn btn-inverse" type="button" onclick="getMenu('stock');">
                            <i class="ace-icon fa fa-share bigger-110"></i>Black
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

    $("#productname").autocomplete({
        source:'<?php echo $path_host; ?>autoc/product',
        // source:availableTags,
        select: function( event, ui ) {
            console.log(ui);
            event.preventDefault();
            $("#productname").val(ui.item.value.name);
            $("#productid").val(ui.item.value.id);
            // addProductOrder(ui.item.value);

            $("#detailproduct").fadeIn();
        }
    });


    function saveStock(type){

        $("#pageContent").load('show');

        var serializeFrm = $("form").serializeArray();

        $.ajax({
            url: 'saveStock',
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
                    getMenu('stock');
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