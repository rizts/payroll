<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $asset_id, $col, $dir) {
    $out = "<a href=\"" . site_url('assets/' . $asset_id . '/details/index') . "?c=";
    //set column query string value
    switch ($key) {
        case "date":
            $out .= "1";
            break;
        case "staff_id":
            $out .= "2";
            break;
        case "descriptions":
            $out .= "3";
            break;
        case "assetd_status":
            $out .= "4";
            break;
        case "assetd_id":
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
    <h2 class="rama-title">Listing Sub Asset</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("Date", "date", $asset_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Staff", "staff_id", $asset_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Descriptions", "descriptions", $asset_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Status", "assetd_status", $asset_id, $col, $dir); ?></th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($assets_details as $row) {
            $row_staff = $staff->where('staff_id', $row->staff_id)->get();
        ?>
            <tr>
                <td><?php echo $row->date; ?></td>
                <td><?php echo $row_staff->staff_name; ?></td>
                <td><?php echo $row->descriptions; ?></td>
                <td><?php echo $row->assetd_status == 1 ? 'Enable' : 'Disable'; ?></td>
                <td>
<?php echo anchor('assets/' . $row->asset_id . '/details/edit/' . $row->assetd_id, 'Edit'); ?> |
                <?php echo anchor('assets/' . $row->asset_id . '/details/delete/' . $row->assetd_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
            </td>
        </tr>
<?php } ?>
    </table>

    <br>
<?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>