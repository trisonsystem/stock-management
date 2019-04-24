<?php 
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];

    $data['id']             = (!empty($id))? $id : '';
    $data['billNo']         = (!empty($order_no))? $order_no : $billNo;
    $data['sdate']         = (!empty($order_date))? $order_date : '';
    $data['refer_no']         = (!empty($order_refer))? $order_refer : '';
    $data['distributor_id']     = (!empty($distributor_id))? $distributor_id : '';
    $data['distributor_name']   = (!empty($distributor_name))? $distributor_name : '';
    $data['remark']     = (!empty($remark))? $remark : '';
?>

<div class="title_page">
    <h1><?php echo $title; ?></h1>
</div>
<hr>
<div class="row pdTop">
    <div class="widget-body" id="loadBank">
        <div class="widget-main">

            <div class="row">
                <div class="col-xs-12 widthTable">
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label " ><?php echo $this->lang->line('document_number'); ?></label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="hidden" id="order_id" name="order_id" value="<?php echo $data['id']; ?>" readonly="readonly" />
                                <input type="text" id="billNo" name="billNo" value="<?php echo $data['billNo']; ?>" readonly="readonly" />
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label " ><?php echo $this->lang->line('document_date'); ?></label>
                            <div class="col-xs-10 col-sm-2">
                                <div class="input-group">
                                    <input class="form-control date-picker" id="sdate" name="sdate" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $data['sdate']; ?>" readonly="readonly" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label "><?php echo $this->lang->line('refer_number'); ?></label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="text" id="refer_no" name="refer_no" value="<?php echo $data['refer_no']; ?>" />
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label "><?php echo $this->lang->line('distributor'); ?></label>
                            <div class="col-xs-10 col-sm-4">
                                <input type="hidden" id="distributorid" name="distributorid" style="width:74%;" value="<?php echo $data['distributor_id']; ?>" />
                                <input type="text" id="distributorname" name="distributorname" style="width:74%;" value="<?php echo $data['distributor_name']; ?>" <?php if($data['id'] !=''){ echo 'readonly';} ?> />
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label "><?php echo $this->lang->line('distributor'); ?></label>
                            <div class="col-xs-10 col-sm-3">
                                <!-- <input type="text" id="productid" name="productid" value="<?php echo $data['product_id']; ?>"> -->
                                <input type="text" id="productname" name="productname" class="col-xs-12 col-sm-12" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label " ><?php echo $this->lang->line('note'); ?></label>
                            <div class="col-xs-10 col-sm-6">
                               <textarea class="autosize-transition form-control" id="remark" name="remark" placeholder="" style=""><?php echo $data['remark']; ?></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="importOrder" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" ><?php echo $this->lang->line('no'); ?></th>
                                    <th><?php echo $this->lang->line('product_code'); ?></th>
                                    <th ><?php echo $this->lang->line('product_name'); ?></th>
                                    <th ><?php echo $this->lang->line('unit'); ?></th>
                                    <th ><?php echo $this->lang->line('qty'); ?></th>
                                    <th ><?php echo $this->lang->line('price_unit'); ?></th>
                                </tr>
                            </thead>

                            <tbody></tbody>
                            <!-- <tfoot> -->
                            	<!-- <tr>
                            		<td colspan="5"  rowspan="4"></td>
                            		<td align="center">รวม</td>
                            		<td align="center">ss</td>
                            	</tr> -->
                            	<!-- <tr>
                                    <td align="center">ส่วนลดรวม</td>
                                    <td align="center">390.00</td>
                                </tr>
                                <tr>
                                    <td align="center">ภาษีมูลค่าเพิ่ม 7%</td>
                                    <td align="center">390.00</td>
                                </tr>
                                <tr>
                                    <td align="center">รวมทั้งหมด</td>
                                    <td align="center">390.00</td>
                                </tr> -->
                            <!-- </tfoot> -->
                        </table>
                    </div>
                	<div class="clearfix form-actions">
                        <div class="col-xs-12" style="text-align: center;">
                            <button class="btn btn-info" type="button" onclick="saveImportOrder();">
                                <i class="ace-icon fa fa-check bigger-110"></i>Submit
                            </button>&nbsp;
                            <button class="btn btn-danger" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>Reset
                            </button>&nbsp;
                            <button class="btn btn-inverse" type="button" onclick="getMenu('unit');">
                                <i class="ace-icon fa fa-share bigger-110"></i>Black
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
        </div>
    </div>
</div>

<script type="text/javascript">
	
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

	//## autocomplete
	$("#distributorname").autocomplete({
        source:'<?php echo $path_host; ?>autoc/distributor',
        // source:availableTags,
        select: function( event, ui ) {
            console.log(ui);
            event.preventDefault();
            $("#distributorname").val(ui.item.value.name);
            $("#distributorid").val(ui.item.value.id);
            // addProductOrder(ui.item.value);

            // $("#detailproduct").fadeIn();
        }
    });

    $("#productname").autocomplete({
        source:'<?php echo $path_host; ?>autoc/product_unit',
        // source:availableTags,
        select: function( event, ui ) {
            console.log(ui);
            event.preventDefault();
            // $("#productname").val();
            // $("#productid").val();
            addProductOrder(ui.item.value);

            // $("#detailproduct").fadeIn();
        }
    });
    //##

    function addProductOrder(arrValue){

    	if($("table#importOrder tbody tr#tr"+arrValue.id).html() != undefined){return false;}

    	var strHtml = '';
    	var trCount = $("table#importOrder tbody tr").length;
    	var no = parseInt(trCount)+1;

    	strHtml += '<tr id="tr'+arrValue.id+'">';
     	strHtml += ' 	<td align="center">'+no+'<input type="hidden" class="pId" value="'+arrValue.id+'"/></td>';
     	strHtml += '	<td align="center">'+arrValue.code+'</td>';
     	strHtml += '	<td align="center">'+arrValue.name+'</td>';
     	strHtml += '	<td align="center">'+arrValue.unit+'</td>';
     	strHtml += '	<td align="center">';
     	strHtml += '		<input type="text" class="inp-amount" value="0" onkeypress="validate_number(event)" />';
     	strHtml += '	</td>';
     	strHtml += '	<td align="center">';
     	strHtml += '		<input type="text" class="inp-price" value="0.00" onkeypress="validate_number(event)" />';
     	strHtml += '	</td>';
     	strHtml += '</tr>';

     	if(trCount > 1){
     		$("table#importOrder tbody tr:last").after(strHtml);
     	}else{
     		$("table#importOrder tbody").append(strHtml);
     	}

        $("#productname").val("");
    }


    function saveImportOrder(){
    	var serializeFrm = $("#frmImportOrder").serializeArray();
        // serializeFrm.push({name: 'bt', value: type});
        
        if(validate_isnull(serializeFrm)){
            var list = {}; var c = 0;
            $('#importOrder tbody tr').each(function() {
                var amount = $(this).find('.inp-amount').val();
                var price = $(this).find('.inp-price').val();
                var pId = $(this).find('.pId').val();
                
                list[c] = {'product_id':pId, 'amount':amount, 'price':price};
                c = c + 1;
            });

            $.ajax({
                url: 'manage_importorder/saveImportOrder',
                data: {"header":serializeFrm,"list":list},
                type: 'POST',
                dataType: 'json',
                success:function(response){
                    console.log(response);

                    if(response.status){
                        $.gritter.add({
                            title: "",
                            text: '<h5><i class="fa fa-check" aria-hidden="true"></i> '+response.msg+'</h5>',
                            class_name: 'gritter-success'
                        });
                        getMenu('manage_importorder/index');
                    }else{
                        $.gritter.add({
                            title: "",
                            text: '<h5><i class="fa fa-ban" aria-hidden="true"></i> '+response.msg+'</h5>',
                            class_name: 'gritter-error'
                        });
                    }
                }
            });
        }else{
            console.log("error-xxxxx")
        }
		
    }

    function validate_isnull(Data){
        var status = true;

        $.each(Data,function(k,v){
            if(v.name != "order_id" && v.name != "distributorname" && v.name != "productname" && v.name != "remark"){
                var obj = $("#"+v.name);
                if(obj.val() == ""){
                    obj.addClass("error-form");
                    obj.focus();
                    status = false;
                }else{
                    obj.removeClass("error-form");
                }
            }
        }); 

        return status;
    }

    function validate_number(evt)
    {
        if(evt.keyCode!=8){
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]|\./;
            if (!regex.test(key))
            {
                theEvent.returnValue = false;

                if (theEvent.preventDefault)
                    theEvent.preventDefault();
            }
        }
    }
</script>