<?php 
    $path_host  = $this->config->config['base_url'];
    $keyword    = $this->config->config['keyword'];
    
    // debug($listData, true);
?>
<?php if($checkdata == 1): ?>
    <?php foreach($listData as $key => $value): ?>
    <tr  style="">
        <td align="center"><?php echo $value->autokey; ?></td>
        <td><?php echo $value->name; ?></td>
        <td align="center">
            <a onclick="" >
                <button class="btn btn-white" style="padding:2px 5px;" onclick="getMenu('editProducttype/<?php echo $value->id; ?>')">
                    <i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $this->lang->line('edit'); ?>
                </button>
                <button class="btn btn-white" style="padding:2px 5px;" onclick="delProductType('<?php echo $value->id; ?>');">
                    <i class="fa fa-times" aria-hidden="true"></i> <?php echo $this->lang->line('delete'); ?>
                </button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="3"><center>No Data</center></td></tr>
<?php endif; ?>