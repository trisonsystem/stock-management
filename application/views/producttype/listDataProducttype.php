<?php 
    $path_host  = $this->config->config['base_url'];
    $keyword    = $this->config->config['keyword'];
    // debug($listData);
?>
<?php if($listData != ''): ?>
    <?php foreach($listData as $key => $value): ?>
    <tr  style="">
        <td align="center"><?php echo $value->autokey; ?></td>
        <td align="center"><?php echo $value->name; ?></td>
        <td align="center">
            <a onclick="" >
                <button class="btn btn-white" style="padding:2px 5px;" onclick="getMenu('editStock/<?php echo $value->id; ?>')">
                    <i class="fa fa-pencil" aria-hidden="true"></i> แก้ไข
                </button>
                <button class="btn btn-white" style="padding:2px 5px;" onclick="delStock('<?php echo $value->id; ?>');">
                    <i class="fa fa-times" aria-hidden="true"></i> ลบ
                </button>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="10"><center>No Data</center></td></tr>
<?php endif; ?>