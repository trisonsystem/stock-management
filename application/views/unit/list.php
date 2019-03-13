<?php $path_assets = base_url() . "assets/"; ?>
<style type="text/css">
	.row{ margin-top: 5px; }
	#box-manage{
		transition: 0.5s;
		width: 0px;
		min-height: 500px;
		right: 0px;
		float: right;
	}
	#box-show-search{
		transition: 0.5s;
		width: 100%;
		left: 0px;
		float: left;
	}
	.fa-edit{ color: green; }
	.fa{ cursor: pointer; }
	.form-check-input{ cursor: pointer; }
	.error-form{ 
		border: 1px solid red !important;
	}
	.title_page{border-bottom: 1px solid #D9D9D9}
</style>

<div class="row title_page">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h3 style="font-weight: bold;"><?php echo $title; ?></h3>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<button type="button" class="btn btn-secondary" onclick="to_add_data( '0', '0' )" id="btn-toadd_data" style="margin-top: 10px; width: 100px;"><?php echo $this->lang->line('add'); ?></button>
		<button type="button" class="btn btn-warning" onclick="to_manage_data()" id="btn-tomanage_data" style="margin-top: 10px; width: 100px; display: none;"><?php echo $this->lang->line('cancel'); ?></button>
	</div>
</div>
<br>
<div id="box-show-search">
	<div class="box-search">
		<?php // debug($division); ?>
		
		<div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('unit'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<input type="text" id="txtProducttype" class="form-control" name="txtProducttype">
            </div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				<span><?php echo $this->lang->line('status'); ?> : </span>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				<select id="slStatus_producttype" name="slStatus_producttype" class="form-control">
					<option value=""> -- <?php echo $this->lang->line('select_status'); ?> -- </option>
					<option value="1"><?php echo $this->lang->line('use'); ?></option>
                    <option value="9"><?php echo $this->lang->line('use_no'); ?></option>
				</select>
            </div>
		</div>

		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<button type="button" class="btn btn-primary" onclick="get_data_list()"><?php echo $this->lang->line('search'); ?></button>
				<button type="button" class="btn btn-warning" onclick="clear_data()"><?php echo $this->lang->line('clear'); ?></button>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 text-right">
				
			</div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
				
            </div>			
		</div>		
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table class="table" id="tb-div-list">
				<thead>
					<tr>
						<th class="text-center"><?php echo $this->lang->line('no'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('product_type'); ?></th>
						<th class="text-center" width="10%"><?php echo $this->lang->line('status'); ?></th>	
						<th class="text-center"><?php echo $this->lang->line('action'); ?></th>					
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <button type="button" class="btn btn-link btn-xs" id="bnt-Previous" onclick="previous(page - 1)" style="display: none;"><< Previous</button>
            <span id="div-page-number" class="div-page-number"></span>
            <button type="button" class="btn btn-link btn-xs" id="bnt-next" onclick="next_page(page + 1)" style="display: none;">Next >></button>
        </div>
    </div>
</div>