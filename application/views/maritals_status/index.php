<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('maritals_status') . "?c=";
    //set column query string value
    switch ($key) {
        case "sn_name":
            $out .= "1";
            break;
        case "sn_id":
            $out .= "2";
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
    <h2 class="rama-title">Listing Marital Status</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="45%"><?php echo HeaderLink("SN ID", "sn_id", $col, $dir); ?></th>
                <th width="45%"><?php echo HeaderLink("Status Name", "sn_name", $col, $dir); ?></th>
                <th width="10%" class="action_cell" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($marital_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sn_id; ?></td>
                <td><?php echo $row->sn_name; ?></td>
                <td class="action_cell"><?php echo anchor('maritals_status/edit/' . $row->sn_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('maritals_status/delete/' . $row->sn_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>
