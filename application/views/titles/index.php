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
<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-tag"></span>
      </div>
      <h1>Title
      <small>Manage title</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="head blue">
      <?php echo header_btn_group("#", "titles/add");?>
    </div>
    <div id="search_bar" class="widget-header">
      <?php search_form(array(""=>"By","branch_name"=>"Branch name")); ?>
    </div>
    <table class="table fpTable table-hover">
      <thead>
        <tr>
          <th width="10%"><?php echo HeaderLink("Title ID", "title_id", $col, $dir); ?></th>
          <th width="80%"><?php echo HeaderLink("Title Name", "title_name", $col, $dir); ?></th>
          <th width="10%" colspan="2" class="action_cell">Action</th>
        </tr>
      </thead>
      <?php
      foreach ($title_list as $row) {
      ?>
        <tr>
          <td><?php echo $row->title_id; ?></td>
          <td><?php echo $row->title_name; ?></td>
          <td class="action_cell">
            <?php btn_action('titles/edit/'.$row->title_id, "Edit User", "titles/delete/". $row->title_id); ?>
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
