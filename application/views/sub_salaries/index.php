<?php get_header(); ?>
<?php
function HeaderLink($value, $key, $salary_id, $col, $dir) {
    $out = "<a href=\"" . site_url('salaries/' . $salary_id . '/sub_salaries/index') . "?c=";
    //set column query string value
    switch ($key) {
        case "salary_periode":
            $out .= "1";
            break;
        case "salary_daily_value":
            $out .= "2";
            break;
        case "salary_amount_value":
            $out .= "3";
            break;
        case "sub_id":
            $out .= "4";
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
    <h2 class="rama-title">Listing Sub Salaries</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th><?php echo HeaderLink("Sub Salary ID", "sub_id", $salary_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Salary Periode", "salary_periode", $salary_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Salary Daily Value", "salary_daily_value", $salary_id, $col, $dir); ?></th>
                <th><?php echo HeaderLink("Salary Amount Value", "salary_amount_value", $salary_id, $col, $dir); ?></th>
                <th class="action_cell" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($sub_salaries as $row) {
        ?>
            <tr>
                <td><?php echo $row->sub_id; ?></td>
                <td><?php echo $row->salary_periode; ?></td>
                <td><?php echo rupiah($row->salary_daily_value); ?></td>
                <td><?php echo rupiah($row->salary_amount_value); ?></td>
                <td class="action_cell"><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/edit/' . $row->sub_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/delete/' . $row->sub_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>