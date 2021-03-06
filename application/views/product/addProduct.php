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
            <div class="col-xs-12">
                <!-- <form class="form-horizontal" id="frmAddProduct" action="" method="post"> -->
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">รหัสสินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="hidden" id="id" name="id" value="<?php echo $data['id']; ?>" />
                            <input type="text" id="barcode" name="barcode" value="<?php echo $data['barcode']; ?>" />
                        </div>
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">ประเภทสินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <select class="form-control" id="producttype" name="producttype">
                                <option value="1">เครื่องดื่ม</option>
                                <option value="1">อาหาร</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">ชื่อสินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="productname" name="productname" value="<?php echo $data['productName']; ?>" />
                        </div>
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">หน่วยสินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <select class="form-control" id="productunit" name="productunit">
                                <option value="1">ลิตร</option>
                                <option value="1">ชิ้น</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">รูปสินค้า</label>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label">หมายเหตุ</label>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                            <textarea name="remake" id="remake" style="width:100%;"></textarea>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" onclick="saveProduct();">
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


    function saveProduct(type){

        // $("#pageContent").load('show');

        // var serializeFrm = $("form").serializeArray();

        // $.ajax({
        //     url: 'saveProduct',
        //     type: 'POST',
        //     data: serializeFrm,
        //     dataType: 'json',
        //     success: function (response) {
        //         console.log(response);
        //         $("#pageContent").load('hide');
                
        //         if(response.status){
        //             $.gritter.add({
        //                 title: "",
        //                 text: '<h5><i class="fa fa-check" aria-hidden="true"></i> '+response.msg+'</h5>',
        //                 class_name: 'gritter-success'
        //             });
        //             getMenu('product');
        //         }else{
        //             $.gritter.add({
        //                 title: "",
        //                 text: '<h5><i class="fa fa-ban" aria-hidden="true"></i> '+response.msg+'</h5>',
        //                 class_name: 'gritter-error'
        //             });
        //         }
                
        //     },
        //     error: function (response) {
        //         console.log(response);
        //     }
        // });
        // ===============================
        $.ajax({
            url: 'saveProduct',
            type: 'POST',
            data: new FormData($('form')[0]),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            $('progress').attr({
                                value: e.loaded,
                                max: e.total,
                            });
                        }
                    } , false);
                }
                return myXhr;
            },
            success: function (response) {

                response = JSON.parse(response);
                console.log(response);
                // if(response.status_flag == true){
                //     dialogSuccess(response.msg);
                //     getMenu('news');
                // }else{
                //     dialogError(response.msg);
                // }
            }
        });
    }

	
</script>