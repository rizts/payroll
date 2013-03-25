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

<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-money-bag"></span>
      </div>
      <h1>Salary component
      <small>Manage salary component</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="head blue">
      <?php echo header_btn_group("#", "components/add");?>
    </div>
    <div id="search_bar" class="widget-header">
      <?php search_form(array(""=>"By","comp_name"=>"Component name", "comp_type"=>"Component Type")); ?>
    </div>
    <table class="table fpTable table-hover">
      <thead>
        <tr>
          <th width="10%"><?php echo HeaderLink("Comp ID", "comp_id", $col, $dir); ?></th>
          <th width="40%"><?php echo HeaderLink("Comp Name", "comp_name", $col, $dir); ?></th>
          <th width="40%"><?php echo HeaderLink("Comp Type", "comp_type", $col, $dir); ?></th>
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
            <td class="action_cell">
              <?php btn_action('components/edit/'.$row->comp_id, "Edit User", "components/delete/". $row->comp_id); ?>
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
