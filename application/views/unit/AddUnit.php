<div class="page-content loadpage">
    <div class="page-header">
        <h1>
            <?php if($data['id'] == ''): ?>
                <?php echo $this->lang->line('add_unit'); ?>
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    <?php echo $this->lang->line('unit_list'); ?>
                </small>
            <?php else: ?>
                <?php echo $this->lang->line('edit_unit'); ?>
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    <?php echo $this->lang->line('unit_list'); ?>
                </small>
            <?php endif; ?>
        </h1>
    </div>
    <form class="form-horizontal" id="frmAddUnit" action="" method="post">
        <div class="row">
            <div class="col-xs-12">
                    <input type="hidden" name="unitid" value="<?php echo $data['id']; ?>">                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2">
                            <label class="control-label"><?php echo $this->lang->line('unit'); ?></label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <input type="text" id="unitname" name="unitname" class="col-xs-12 col-sm-12" value="<?php echo $data['unit_name']; ?>" />
                        </div>
                    </div>
            </div>            
            <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button" onclick="saveUnit();">
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
    </form>

</div>
<script type="text/javascript">
    function saveUnit(type){

        $("#pageContent").load('show');

        var serializeFrm = $("form").serializeArray();

        $.ajax({
            url: 'saveUnit',
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
                    getMenu('unit');
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