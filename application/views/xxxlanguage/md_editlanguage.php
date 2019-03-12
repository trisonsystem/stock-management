<?php 
if (isset($byword)) {
    $byword = json_decode($byword, true)['data'];
} else {
    echo 'Error : data not found.';
}
// debug($byword);
?>
<!-- Modal body -->

<form name="frmEditModal"enctype="multipart/form-data" id="frmEditModal">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="usr">Word:</label>
                    <input type="text" class="form-control" id="word" name="word" value="<?php echo $byword[0]['word'] ?>">
                </div>

                <div class="form-group">
                    <label for="usr">ภาษาอังกฤษ:</label>
                    <input type="text" class="form-control" id="en" name="en" value="<?php echo $byword[0]['en'] ?>">
                </div>

                <div class="form-group">
                    <label for="usr">ภาษาไทย:</label>
                    <input type="text" class="form-control" id="th" name="th" value="<?php echo $byword[0]['th'] ?>">
                </div>
            </div>
        </div>    
    </div>
            
    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="save_edit_lang()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
<form>