<?php get_header(); ?>
<?php

function HeaderLink($value, $key, $col, $dir) {
    $out = "<a href=\"" . site_url('salaries') . "?c=";
    //set column query string value
    switch ($key) {
        case "salary_periode":
            $out .= "1";
            break;
        case "salary_staffid":
            $out .= "2";
            break;
        case "salary_id":
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
        <span class="ico-coins"></span>
      </div>
      <h1>Salaries
      <small>Manage salaries</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="head blue">
      <?php echo header_btn_group("#", "salaries/add");?>
    </div>
    <div id="search_bar" class="widget-header">
      <?php search_form(array(""=>"By","salary_period"=>"Period")); ?>
    </div>
    <table class="table fpTable table-hover">
      <thead>
        <tr>
          <th width="8%"><?php echo HeaderLink("Salary ID", "salary_id", $col, $dir); ?></th>
          <th width="42%"><?php echo HeaderLink("Salary Periode", "salary_periode", $col, $dir); ?></th>
          <th width="40%"><?php echo HeaderLink("Salary Staff", "salary_staffid", $col, $dir); ?></th>
          <th width="10">Action</th>
        </tr>
      </thead>
      <?php
      foreach ($salaries as $row) {
      ?>
        <tr>
          <td><?php echo $row->salary_id; ?></td>
          <td><?php echo $row->salary_periode; ?></td>
          <td><?php echo $row->salary_staffid; ?></td>
          <td>
            <div class="btn-group">
              <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                <i class="icon-cog"></i>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu pull-right">
                <li><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/add', '<i class="icon-list"></i> Add Sub Salaries'); ?></li>
                <li><?php echo anchor('salaries/edit/' . $row->salary_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                <li><?php echo anchor('salaries/delete/' . $row->salary_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
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
