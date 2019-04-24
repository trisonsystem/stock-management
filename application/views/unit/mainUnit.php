<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>
<div class="row pdTop">
    <div class="widget-body" id="loadMainProductType" style="">
        <div class="widget-main">
            <div class="row">
                <div class="col-xs-12 widthTable">
                    
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-2 control-label" style="max-width:85px;"><?php echo $this->lang->line('search'); ?></label>
                            <div class="col-xs-10 col-sm-3">
                                <input type="text" id="unitname" name="unitname" value="" />
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <button type="button" name="search" id="search" class="btn btn-primary btn-sm" onclick="searchUnit(this);">
                                        <?php echo $this->lang->line('search'); ?>
                                </button>
                                <button type="button" name="add" id="add" class="btn btn-yellow btn-sm" onclick="getMenu('addUnit')">
                                        <?php echo $this->lang->line('add'); ?>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="tbStock" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo $this->lang->line('no'); ?></th>
                                    <th class="text-center"><?php echo $this->lang->line('unit'); ?></th>
                                    <!-- <th class="text-center" width="10%"><?php echo $this->lang->line('status'); ?></th>  -->
                                    <th class="text-center"><?php echo $this->lang->line('action'); ?></th>                 
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
                                            <button type="button" class="btn btn-prev btn-sm" name="prevPage" disabled="" onclick="searchUnit(this);">
                                                <i class="ace-icon fa fa-arrow-left"></i>Prev
                                            </button>
                                            <button type="button" class="btn btn-success btn-next btn-sm" disabled="" name="nextPage" onclick="searchUnit(this);">
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

        searchUnit();
    });

    function searchUnit(btnow){

        $("#loadMainProductType").load('show');

        $.ajax({
            url: 'unitList',
            data: {
                unit_name : $('input[name="unitname"]').val(),
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
                $("#loadMainProductType").load('hide');
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function delUnit(sid){
        
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
                            url: 'delUnit',
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
                                    getMenu('unit');
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