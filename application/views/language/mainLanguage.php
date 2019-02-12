<h1>Setting Language</h1>
<?php 
    // debug($adminlist);
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];
?>

<div class="row pdTop">
    <div class="widget-body" id="loadBank">
        <div class="widget-main">

            <div class="row">
                <div class="col-xs-12 widthTable">
                    
                    <form class="form-horizontal" id="frmImportOrder" action="" method="post">                        
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label ">เลขที่อ้างอิง</label>
                            <div class="col-xs-10 col-sm-2">
                                <input type="text" id="" name=""/>
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label ">ผู้ขาย</label>
                            <div class="col-xs-10 col-sm-4">
                                <input type="text" id="distributor" name="distributor" style="width:74%;" />
                            </div>
                            <label class="col-xs-12 col-sm-1 control-label ">เพิ่มสินค้า</label>
                            <div class="col-xs-10 col-sm-3">
                                <input type="text" id="product" name="product" style="width:100%;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-1 control-label " >หมายเหตุ</label>
                            <div class="col-xs-10 col-sm-6">
                               <textarea class="autosize-transition form-control" id="form-field-8" placeholder="" style=""></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="importOrder" class="table table-striped table-bordered table-hover">
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
                            	<!-- <tr>
                                    <td align="center">1</td>
                                    <td align="center">DM-340</td>
                                    <td align="center">น้ำยาล้างจาน</td>
                                    <td align="center">ขวด</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="10" />
                                    </td>
                                    <td align="center">8.50</td>
                                    <td align="center">
                                    	<input type="text" id="" name="" value="9.00" />
                                    </td>
                                    <td align="center">90.00</td>
                                </tr> -->
                                <?php if(!empty($bookAgent)): ?>
                                    <?php foreach($bookAgent as $key => $value): ?>
                                        
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <!--  <tr>
                                        <td align="center" colspan="8"><strong>no_data</strong></td>
                                    </tr> -->
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                            		<td colspan="4" rowspan="2"></td>
                            		<td align="center">70</td>
                            		<td ></td>
                            		<td ></td>
                            		<td align="center">390.00</td>
                            	</tr>
                            	<tr>
                            		<td colspan="4">
                            			xxxxxxx
                            		</td>
                            	</tr>
                            </tfoot>
                        </table>
                    </div>

                    <div>
                    	<button onclick="saveImportOrder();">Save</button>
                    </div>
                    
                </div>
            </div>

            <hr />
        </div>
    </div>
</div>

<script type="text/javascript"></script>
