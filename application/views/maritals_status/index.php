<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('maritals_status') . "?c=";
    //set column query string value
    switch ($key) {
        case "sn_name":
            $out .= "1";
            break;
        case "sn_id":
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
        <span class="ico-heart"></span>
      </div>
      <h1>Marital Status
      <small>Manage marital status</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="head blue">
      <?php echo header_btn_group("maritals_status/to_excel", "maritals_status/add");?>
    </div>
    <div id="search_bar" class="widget-header">
      <?php search_form(array(""=>"By","sn_name"=>"Status")); ?>
    <table class="table fpTable table-hover">
      <thead>
        <tr>
          <th width="5%"><?php echo HeaderLink("SN ID", "sn_id", $col, $dir); ?></th>
          <th width="85%"><?php echo HeaderLink("Status Name", "sn_name", $col, $dir); ?></th>
          <th width="10%" class="action_cell" colspan="2">Action</th>
        </tr>
      </thead>
      <?php
      foreach ($marital_list as $row) {
      ?>
          <tr>
              <td><?php echo $row->sn_id; ?></td>
              <td><?php echo $row->sn_name; ?></td>
              <td class="action_cell">
                <?php btn_action('maritals_status/edit/'.$row->sn_id, "Edit User", "maritals_status/delete/". $row->sn_id); ?>
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
