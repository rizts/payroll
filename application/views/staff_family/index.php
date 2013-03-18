<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $staff_id, $col, $dir) {
    $out = "<a href=\"" . site_url('staffs/' . $staff_id . '/families/index') . "?c=";
    //set column query string value
    switch ($key) {
        case "staff_fam_order":
            $out .= "1";
            break;
        case "staff_fam_name":
            $out .= "2";
            break;
        case "staff_fam_birthdate":
            $out .= "3";
            break;
        case "staff_fam_birthplace":
            $out .= "4";
            break;
        case "staff_fam_sex":
            $out .= "5";
            break;
        case "staff_fam_relation":
            $out .= "6";
            break;
        case "staff_fam_id":
            $out .= "7";
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
    <?php echo $breadcrumb; ?>
    <h2 class="rama-title">Listing Families</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("Family ID", "staff_fam_id", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Order", "staff_fam_order", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Name", "staff_fam_name", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Birthdate", "staff_fam_birthdate", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Birthplace", "staff_fam_birthplace", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Gender", "staff_fam_sex", $staff_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Family Relation", "staff_fam_relation", $staff_id, $col, $dir); ?></th>
                <th class="action_cell" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($families as $row) {
        ?>
            <tr>
                <td><?php echo $row->staff_fam_id; ?></td>
                <td><?php echo $row->staff_fam_order; ?></td>
                <td><?php echo $row->staff_fam_name; ?></td>
                <td><?php echo $row->staff_fam_birthdate; ?></td>
                <td><?php echo $row->staff_fam_birthplace; ?></td>
                <td><?php echo $row->staff_fam_sex; ?></td>
                <td><?php echo $row->staff_fam_relation; ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/families/edit/' . $row->staff_fam_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/families/delete/' . $row->staff_fam_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php
        }
        ?>
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

