<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('employees_status') . "?c=";
    //set column query string value
    switch ($key) {
        case "sk_name":
            $out .= "1";
            break;
        case "sk_id":
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
    <h2 class="rama-title">Listing Employee Status</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("SK ID", "sk_id", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Status", "sk_name", $col, $dir); ?></th>
                <th colspan="2" width="10%" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($es_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sk_id; ?></td>
                <td><?php echo $row->sk_name; ?></td>
                <td class="action_cell"><?php echo anchor('employees_status/edit/' . $row->sk_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('employees_status/delete/' . $row->sk_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <div class="clearfix"></div>
    <br>
    <div class="pagination pagination-right">
        <ul>
            <?php echo $pagination; ?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>
