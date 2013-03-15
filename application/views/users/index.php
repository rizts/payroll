<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('users') . "?c=";
    //set column query string value
    switch ($key) {
        case "branch_name":
            $out .= "1";
            break;
        case "branch_id":
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
    <h2 class="rama-title">Listing User</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="45%">User ID</th>
                <th width="45%">Username</th>
                <th width="45%">Role</th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($user_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->role_id; ?></td>
                <td class="action_cell"><?php echo anchor('users/edit/' . $row->id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('users/delete/' . $row->id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>
