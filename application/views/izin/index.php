<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('assets') . "?c=";
    //set column query string value
    switch ($key) {
        case "izin_staff_id":
            $out .= "1";
            break;
        case "izin_date":
            $out .= "2";
            break;
        case "izin_jumlah_hari":
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
                <span class="ico-tag"></span>
            </div>
            <h1>Assets
                <small>Manage assets</small>
            </h1>
        </div>
        <br class="cl" />
        <div class="head blue">
            <?php echo header_btn_group("#", "izin/add"); ?>
        </div>
        <div id="search_bar" class="widget-header">
            <?php search_form(array("" => "By", "asset_name" => "Name")); ?>
        </div>
        <table class="table fpTable table-hover">
            <thead>
                <tr>
                    <th width="25%"><?php echo HeaderLink("Staff", "izin_staff_id", $col, $dir); ?></th>
                    <th width="15%"><?php echo HeaderLink("Date", "izin_date", $col, $dir); ?></th>
                    <th width="10%"><?php echo HeaderLink("Jumlah hari", "izin_jumlah_hari", $col, $dir); ?>
                    <th width="40%">Note</th>
                    <th width="10">Action</th>
                </tr>
            </thead>
            <?php
            foreach ($izin->result() as $row) {
            $staff = get_staff_detail($row->izin_staff_id);
            ?>
                <tr>
                    <td><?php echo $staff->staff_name; ?></td>
                    <td><?php echo $row->izin_date; ?></td>
                    <td><?php echo $row->izin_jumlah_hari; ?></td>
                    <td><?php echo $row->izin_note; ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                <i class="icon-cog"></i>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><?php echo anchor('izin/edit/' . $row->izin_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                                <li><?php echo anchor('izin/delete/' . $row->izin_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                            </ul>
                        </div>
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
