<?php     
	$path_host  = $this->config->config['base_url'];
    $keyword    = $this->config->config['keyword'];
    $path_assets = base_url()."assets/";
?>
<div class="title_page">
	<h1><?php echo $title;?></h1>
</div>
<br>
<div class="row" align="right">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="button" class="btn btn-warning" onclick="add_lang()">เพิ่มข้อมูล</button>
    </div>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table" id="list-Language">
            <thead>
            <tr>
                <th>ลำดับ</th>
                <th>word</th>
                <th>ภาษาอังกฤษ</th>
                <th>ภาษาไทย</th>
                <th>จัดการ</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- The Modal Edit -->
<div class="modal fade" id="editLangModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>                
                <div class="title" id="title"></div>
            </div>
             
            <div class="dash" id="dash"></div>  
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $path_assets?>css/Language.css">
<script type="text/javascript">
    
    $(document).ready(function() {
        get_data_list();
    });

    function get_data_list(){
        $.get("language/infoLanguage",{},function( aData ){
            aData = jQuery.parseJSON( aData );
            var str_html  = ""; 
            $.each(aData, function(k , v){                
                str_html += "<tr>"; 
                str_html += " <td>"+( k+1 )+"</td>";
                str_html += " <td>"+v.word+"</td>";
                str_html += " <td>"+v.en+"</td>";
                str_html += " <td>"+v.th+"</td>";
                str_html += " <td align='center'>";
                str_html += " 	<i class='fa fa-edit' style='font-size:20px;' onclick='edit_lang(\""+v.word+"\")'></i>";
                str_html += " 	<i class='fa fa-remove' style='font-size:20px;' onclick='delete_lang(\""+v.word+"\")'></i>";
                str_html += " </td>";
                str_html += "</tr>"; 
            });
            $("#list-Language tbody").html( str_html );
            // console.log( aData );
        });        
    }

    function edit_lang(word){        
        var title = "<h2 class='modal-title'>แก้ไขข้อมูล</h2>";

        $("#editLangModal").modal("show");
        $("#title").html( title );
        $.ajax({
            type: "GET",
            data: {"word":word},
            url:  baseUrl+"language/getLanguageFromWord",
            success: function (data) {
                $("#dash").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function add_lang(){
        $("#dash").empty();
        var title = "<h2 class='modal-title'>เพิ่มข้อมูล</h2>";
        var str_html  = "";
        $("#editLangModal").modal("show");        

        str_html += "<form name='frmLanguage'enctype='multipart/form-data' id='frmLanguage'>"; 
        str_html += "<div class='modal-body'>";
        str_html += "<div class='form-group'>";
        str_html += "<label for='usr'>Word:</label>";
        str_html += "<input type='text' class='form-control' id='word' name='word' value=''>";
        str_html += "</div>";
        str_html += "<div class='form-group'>";
        str_html += "<label for='usr'>ภาษาอังกฤษ:</label>";
        str_html += "<input type='text' class='form-control' id='en' name='en' value=''>";
        str_html += "</div>";
        str_html += "<div class='form-group'>";
        str_html += "<div class='form-group'>";
        str_html += "<label for='usr'>ภาษาไทย:</label>";
        str_html += "<input type='text' class='form-control' id='th' name='th' value=''>";
        str_html += "</div>";
        str_html += "</div>";
        str_html += "<div class='modal-footer'>";
        str_html += "<button type='button' class='btn btn-primary' onclick='save_lang()'>Save</button>";
        str_html += "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>";
        str_html += "</div>";
        str_html += "<form>";
        
        $("#title").html( title );
        $("#dash").html(str_html);
    }

    function save_edit_lang(){        
        var word = document.getElementById("word").value;
        var en = document.getElementById("en").value;
        var th = document.getElementById("th").value;
        
        $.ajax({
            type: "POST",
            url: baseUrl+"language/saveEditLanguage",
            data:{word:word,en:en,th:th},
            success: function (data) {
                callBack = jQuery.parseJSON( data );
                if (callBack.status == 200) {
                    get_data_list(); 
                    $("#editLangModal").modal("hide");                  
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
            if (elem[ob].type != 'button') {
                formData.append(elem[ob].id, $("#" + elem[ob].id).val());               
            }
            if (elem[ob].value != '' && elem[ob].type != 'button') {
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
                    get_data_list(); 
                    $("#myModalAdd").modal("hide");                 
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
                    get_data_list();
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
                        get_data_list();                   
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
                // console.log(data);
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
