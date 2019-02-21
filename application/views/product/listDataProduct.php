<?php 
    $path_host  = $this->config->config['base_url'];
    $keyword    = $this->config->config['keyword'];
    // debug($listData);
?>
<?php if($listData != ''): ?>
    <?php foreach($listData as $key => $value): ?>
    <tr  style="">
        <td align="center"><?php echo $value->autokey; ?></td>
        <td align="center"><?php echo $value->code; ?></td>
        <td align="center"><?php echo $value->name; ?></td>
        
    </tr>
    <?php endforeach; ?>
<?php endif; ?>