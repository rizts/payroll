<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('components') . "?c=";
    //set column query string value
    switch ($key) {
        case "comp_name":
            $out .= "1";
            break;
        case "comp_type":
            $out .= "2";
            break;
        case "comp_id":
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
    <h2 class="rama-title">Listing Component(Gaji)</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="30%"><?php echo HeaderLink("Comp ID", "comp_id", $col, $dir); ?></th>
                <th width="30%"><?php echo HeaderLink("Comp Name", "comp_name", $col, $dir); ?></th>
                <th width="30%"><?php echo HeaderLink("Comp Type", "comp_type", $col, $dir); ?></th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($components as $row) {
        ?>
            <tr>
                <td><?php echo $row->comp_id; ?></td>
                <td><?php echo $row->comp_name; ?></td>
                <td><?php echo $row->comp_type; ?></td>
                <td class="action_cell"><?php echo anchor('components/edit/' . $row->comp_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('components/delete/' . $row->comp_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
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
