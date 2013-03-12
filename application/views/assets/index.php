<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('assets') . "?c=";
    //set column query string value
    switch ($key) {
        case "asset_name":
            $out .= "1";
            break;
        case "asset_status":
            $out .= "2";
            break;
        case "staff_id":
            $out .= "3";
            break;
        case "date":
            $out .= "4";
            break;
        case "staff_id":
            $out .= "5";
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
    <h2 class="rama-title">Listing Asset</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("Asset ID", "asset_id", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Asset Name", "asset_name", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Asset Status", "asset_status", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Staff ID", "staff_id", $col, $dir); ?></th>
                <th><?php echo HeaderLink("Date", "date", $col, $dir); ?></th>
                <th width="10">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($asset_list as $row) {
            $row_staff = $staff->where('staff_id', $row->staff_id)->get();
        
        ?>
            <tr>
                <td><?php echo $row->asset_id; ?></td>
                <td><?php echo $row->asset_name; ?></td>
                <td><?php echo $row->asset_status; ?></td>
                <td><?php echo $row_staff->staff_name; ?></td>
                <td><?php echo $row->date; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            <i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor('assets/' . $row->asset_id . '/details/add', '<i class="icon-list"></i> Add Detail'); ?></li>
                            <li><?php echo anchor('assets/edit/' . $row->asset_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('assets/delete/' . $row->asset_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>
