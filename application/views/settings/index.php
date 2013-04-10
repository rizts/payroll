<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('settings') . "?c=";
    //set column query string value
    switch ($key) {
        case "name":
            $out .= "1";
            break;
        case "value":
            $out .= "2";
            break;
        case "id":
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
<div class="body">
    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>
        <div class="page-header">
            <div class="icon">
                <span class="ico-site-map"></span>
            </div>
            <h1>Settings
                <small>Setting Parameter</small>
            </h1>
        </div>
        <br class="cl" />
        <div class="head blue">
            <?php echo header_btn_group("settings/to_excel", "settings/add"); ?>
        </div>
        <div id="search_bar" class="widget-header">
            <?php search_form(array("" => "By", "name" => "Setting name")); ?>
        </div>
        <table class="table fpTable table-hover">
            <thead>
                <tr>
                    <th width="5%"><?php echo HeaderLink("ID", "id", $col, $dir); ?></th>
                    <th width="50%"><?php echo HeaderLink("Name", "name", $col, $dir); ?></th>
                    <th width="50%"><?php echo HeaderLink("Value", "value", $col, $dir); ?></th>
                    <th width="10%" class="action_cell">Action</th>
                </tr>
            </thead>
            <?php
            foreach ($settings as $row) {
            ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->value; ?></td>
                    <td class="action_cell">
                    <?php btn_action('settings/edit/' . $row->id, "Edit", "settings/delete/" . $row->id); ?>
                </td>
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
</div>
<?php get_footer(); ?>
