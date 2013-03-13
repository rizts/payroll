<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('users/roles') . "?c=";
    //set column query string value
    switch ($key) {
        case "role_name":
            $out .= "1";
            break;
        case "role_id":
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
    <h2 class="rama-title">Listing Role</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("Role ID", "role_id", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Role Name", "role_name", $col, $dir); ?></th>
                <th width="10">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($role_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->role_id; ?></td>
                <td><?php echo $row->role_name; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            <i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor('users/roles/' . $row->role_id . '/role_details/add/', '<i class="icon-list"></i> Add Detail'); ?></li>
                            <li><?php echo anchor('users/edit_role/' . $row->role_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('users/delete_role/' . $row->role_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                        </ul>
                    </div>    
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <?php echo $pagination; ?>
        <br>
    </div>
<?php get_footer(); ?>
