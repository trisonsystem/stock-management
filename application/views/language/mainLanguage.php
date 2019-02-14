<?php 
    // $d = json_decode($lang, true);
    // debug($d);
	$path_host  = $this->config->config['base_url'];
    $keyword    = $this->config->config['keyword'];
    $path_assets = base_url()."assets/";

    if (isset($field)) {
        $field = json_decode($field, true);
    }else{
        exit();
    }
?>
<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-sm-8">            
                <div class="panel panel-primary" >
                    <div class="panel-heading">เพิ่มข้อมูล</div>
                    <div class="panel-body">
                        <!-- <form class="form-horizontal" id="frmLanguage" action="" method="post"> -->
                        <form name="frmLanguage"enctype="multipart/form-data" id="frmLanguage">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="usr">คีย์:</label>
                                    <input type="text" class="form-control" id="word" name="word">
                                </div>                                    
                                <?php 
                                if (isset($field['title'])) {                                        
                                    foreach ($field['title'] as $key => $value) {
                                        $str_html  = '';
                                        $str_html  .= '<div class="col-sm-6">';
                                        $str_html  .= '  <label for="usr">'.$value['Field'].':</label>';
                                        $str_html  .= '  <input type="text" class="form-control" id="'.$value['Field'].'" name="'.$value['Field'].'">';
                                        $str_html  .= '</div>';
                                        echo($str_html);
                                    }
                                }
                                ?>
                                <div class="col-sm-6">
                                    <br><button type="button" class="btn btn-primary btn-block" id="bt-save-lang" onclick="save_lang()">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-warning" >
                    <div class="panel-heading">เพิ่มภาษา</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="usr">ภาษา:</label>
                                <input type="text" class="form-control" id="field" name="field">
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br><button type="button" class="btn btn-primary btn-block" id="bt-save-lang" onclick="save_field_lang()">Save</button>
                            </div> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                if(isset($field['title'])){                                    
                                    $str_html  = '';
                                    $str_html  .= '<table class="table">';
                                    $str_html  .= '<thead>';
                                    $str_html  .= '<tr>';
                                    $str_html  .= '  <th>ภาษา</th>';
                                    $str_html  .= '  <th>จัดการ</th>';
                                    $str_html  .= '</tr>';
                                    $str_html  .= '</thead>';
                                    $str_html  .= '<tbody>';

                                    foreach ($field['title'] as $kt => $vt) {
                                    $str_html  .= '<tr>';
                                    $str_html  .= ' <td>'.$vt['Field'].'</td>';
                                    $str_html  .= " <td align='center'>";
                                    $str_html  .= " 	<i class='fa fa-remove' style='font-size:20px;' onclick='delete_field_lang(\"".$vt['Field']."\")'></i>";
                                    // $str_html  .= " 	<i class='fa fa-remove' style='font-size:20px;' onclick='delete_lang(\"".$vlist['word']."\")'></i>";
                                    $str_html  .= " </td>";
                                    $str_html  .= '</tr>';
                                    }

                                    $str_html  .= '</tbody>';
                                    $str_html  .= '</table>';
                                    echo($str_html);
                                }
                                ?>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>            
        </div>
             
    </div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <?php 
        if (isset($field['list'])): 
            $str_html  = '';
            $str_html  .= '<table class="table" id="listLanguage">';
            $str_html  .= '<thead>';
            $str_html  .= '<tr>';
            $str_html  .= '  <th>ลำดับ</th>';
            $str_html  .= '  <th>word</th>';

            foreach ($field['title'] as $ktitle => $vtitle) {
                $str_html  .= '  <th>'.$vtitle['Field'].'</th>';
            }

            $str_html  .= '  <th>จัดการ</th>';
            $str_html  .= '</tr>';
            $str_html  .= '</thead>';
            $str_html  .= '<tbody>';            

            foreach ($field['list'] as $klist => $vlist) {
                $no = $klist + 1;
                $str_html  .= '<tr>';
                $str_html  .= ' <td>'.$no.'</td>';
                $str_html  .= ' <td>'.$vlist['word'].'</td>';

                $str = ""; $str1 = "";
                foreach ($field['title'] as $k => $v) {
                    $str_html  .= ' <td>'.$vlist[$v['Field']].'</td>';
                    $str .= $vlist[$v['Field']].",";
                    $str1 .= $v['Field'].",";
                }

                $str_html  .= " <td align='center'>";
                $str_html  .= " 	<i class='fa fa-edit' style='font-size:20px;' onclick='edit_lang(\"".$vlist['word']."\",\"".$str."\",\"".$str1."\")'></i>";
                $str_html  .= " 	<i class='fa fa-remove' style='font-size:20px;' onclick='delete_lang(\"".$vlist['word']."\")'></i>";
                $str_html  .= " </td>";
                $str_html  .= '</tr>';

            }            
            
            $str_html  .= '</tbody>';
            $str_html  .= '</table>';

            echo($str_html);
            ?>             
		
        <?php endif; ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="editLangModal" role="dialog">
    <div class="modal-dialog">    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">แก้ไขข้อมูล</h4>
            </div>
            <form name="frmEditModal"enctype="multipart/form-data" id="frmEditModal">
            <span id="xid"></span>            
            <form>
        </div>      
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Language.css">
<script type="text/javascript">

    
    
    $(document).ready(function() {
        
    });

    function edit_lang(word, data, data1){        
        var str_html = ""; var i;
        const list = data.split(',');
        const title = data1.split(',');
               
        str_html += "<div class='modal-body'>";
        str_html += "<p><h3>word : " + word + "</h3></p>";
        str_html += "   <input type='text' class='form-control' id='eword' name='eword' value='"+word+"'>";
        for (i = 0; i < title.length - 1; i++) {         
            str_html += "<div class='form-group'>";
            str_html += "   <label for='usr'>"+title[i]+":</label>";
            str_html += "   <input type='text' class='form-control' id='"+title[i]+"' name='"+title[i]+"' value='"+list[i]+"'>";
            // str_html += "   <input type='text' class='form-control' id='"+title[i]+"' name='"+title[i]+"' value=\".title[i]."\">";
            str_html += "</div>";
        }
        str_html += "</div>";
        str_html += "<div class='modal-footer'>";
        str_html += "   <button type='button' class='btn btn-primary' onclick='save_edit_lang()'>Save</button>";
        str_html += "   <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
        str_html += "</div>";

        $("#xid").html( str_html );
        $("#editLangModal").modal("show");
    }

    function save_edit_lang(){
        var formData = new FormData();
        var elem = document.getElementById('frmEditModal').elements;
                
        for (var ob = 0; ob < elem.length; ob++) {
            // if (elem[ob].id != 'bt-save-lang') {
                // console.log(elem[ob].id + "-------" + elem[ob].value);
                
                formData.append(elem[ob].id, elem[ob].value);
            
        }

        $.ajax({
            url: baseUrl+"language/saveEditLanguage",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            enctype: 'multipart/form-data',
            success: function (data) {
                // console.log(data);
                callBack = jQuery.parseJSON( data );
                if (callBack.status == 200) {
                    getMenu('language/index');                   
                }else{
                    alert("Can not save data.");
                }
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }
        
    function save_lang(){ 
        var formData = new FormData();
        var elem = document.getElementById('frmLanguage').elements;
        var chkWord = document.getElementById("word").value;
        var chk = 0;
                
        if (chkWord == '') {
            alert("Can not save data.");
            return false;
        }
        
        for (var ob = 0; ob < elem.length; ob++) {
            if (elem[ob].id != 'bt-save-lang') {
                formData.append(elem[ob].id, $("#" + elem[ob].id).val());
            }
            if (elem[ob].value != '' && elem[ob].id != 'bt-save-lang') {
                chk = chk + 1;
            }
        }

        if (chk < 2) {
            alert("Can not save data.");
            return false;
        }
        
        $.ajax({
            url: baseUrl+"language/saveLanguage",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            enctype: 'multipart/form-data',
            success: function (data) {
                // console.log(data);
                callBack = jQuery.parseJSON( data );
                if (callBack.status == 200) {
                    getMenu('language/index');                   
                }else{
                    alert("Can not save data.");
                }
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }

    function delete_lang(word){        
        $.ajax({
            type: "POST",
            url: baseUrl+"language/deleteLanguage",
            data:{word:word},
            success: function (data) {
                console.log(data);
                callBack = jQuery.parseJSON( data );
                if (callBack.status == 200) {
                    getMenu('language/index');
                }else{
                    alert("Can not delete data.");
                }
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }

    function save_field_lang(){
        var field = document.getElementById("field").value;
        
        if (field == '') {
            alert("Can not save data.");
        } else {
            $.ajax({
                type: "POST",
                url: baseUrl+"language/saveFieldLang",
                data:{field:field},
                success: function (data) {
                    callBack = jQuery.parseJSON( data );
                    // console.log(callBack);
                    
                    if (callBack.status == 200) {
                        getMenu('language/index');                   
                    }else{
                        alert("Can not save data.");
                    }
                },
                error: function (err) {
                    console.log(err);
                    console.log('ccccccccccccc');
                } 
            });
        }
    }

    function delete_field_lang(field){        
        $.ajax({
            type: "POST",
            url: baseUrl+"language/deleteFieldLang",
            data:{field:field},
            success: function (data) {
                console.log(data);
                callBack = jQuery.parseJSON( data );
                if (callBack.status == 200) {
                    getMenu('language/index');
                }else{
                    alert("Can not delete data.");
                }
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }
</script>
