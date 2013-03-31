<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('branches') . "?c=";
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
<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-site-map"></span>
      </div>
      <h1>Branch
      <small>Manage branch</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="head blue">
      <?php echo header_btn_group("branches/to_excel", "branches/add");?>
    </div>
    <div id="search_bar" class="widget-header">
      <?php search_form(array(""=>"By","branch_name"=>"Branch name")); ?>
    </div>
    <table class="table fpTable table-hover">
        <thead>
            <tr>
                <th width="5%"><?php echo HeaderLink("Branch ID", "branch_id", $col, $dir); ?></th>
                <th width="50%"><?php echo HeaderLink("Branch Name", "branch_name", $col, $dir); ?></th>
                <th width="10%" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($branch_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->branch_id; ?></td>
                <td><?php echo $row->branch_name; ?></td>
                <td class="action_cell">
                  <?php btn_action('branches/edit/'.$row->branch_id, "Edit User", "branches/delete/". $row->branch_id); ?>
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
