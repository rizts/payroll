<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('titles') . "?c=";
    //set column query string value
    switch ($key) {
        case "title_name":
            $out .= "1";
            break;
        case "title_id":
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
    <h2 class="rama-title">Listing Title</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="45%"><?php echo HeaderLink("Title ID", "title_id", $col, $dir); ?></th>
                <th width="45%"><?php echo HeaderLink("Title Name", "title_name", $col, $dir); ?></th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($title_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->title_id; ?></td>
                <td><?php echo $row->title_name; ?></td>
                <td class="action_cell"><?php echo anchor('titles/edit/' . $row->title_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('titles/delete/' . $row->title_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
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
