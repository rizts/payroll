<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('taxes_employees') . "?c=";
    //set column query string value
    switch ($key) {
        case "sp_status":
            $out .= "1";
            break;
        case "sp_ptkp":
            $out .= "2";
            break;
        case "sp_id":
            $out .= "3";
            break;
        default:
            $out .= "0";
    }

    $out .= "&d=";

    //reverse sort if the current column is clicked
    if ($key == $col) {
        switch ($dir) {
            case "ASC":
                $out .= "1";
                break;
            default:
                $out .= "0";
        }
    } else {
        //pass on current sort direction
        switch ($dir) {
            case "ASC":
                $out .= "0";
                break;
            default:
                $out .= "1";
        }
    }

    //complete link
    $out .= "\">$value</a>";

    return $out;
}
?>

<div class="wrap">
    <?php echo $this->session->flashdata('message'); ?>
    <h2 class="rama-title">Tax Status</h2>
    <div class="float-right"><?php echo $btn_add ?></div>    
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="30%"><?php echo HeaderLink("SP ID", "sp_id", $col, $dir); ?></th>
                <th width="30%"><?php echo HeaderLink("SP Status", "sp_status", $col, $dir); ?></th>
                <th width="30%"><?php echo HeaderLink("SP PTKP", "sp_ptkp", $col, $dir); ?></th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($tax_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sp_id; ?></td>
                <td><?php echo $row->sp_status; ?></td>
                <td><?php echo rupiah($row->sp_ptkp); ?></td>
                <td class="action_cell"><?php echo anchor('taxes_employees/edit/' . $row->sp_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('taxes_employees/delete/' . $row->sp_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>

<?php get_footer(); ?>
