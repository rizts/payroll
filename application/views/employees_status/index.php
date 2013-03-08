<?php get_header(); ?>
<div class="wrap">
  <?php echo $this->session->flashdata('message'); ?>
    <h2 class="rama-title">Listing Employee Status</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
          <tr>
              <th>SK ID</th>
              <th>Status</th>
              <th colspan="2" width="10%" class="action_cell">Action</th>
          </tr>
        </thead>
        <?php
        foreach ($es_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sk_id; ?></td>
                <td><?php echo $row->sk_name; ?></td>
                <td class="action_cell"><?php echo anchor('employees_status/edit/' . $row->sk_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('employees_status/delete/' . $row->sk_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
    
        </div>
<?php get_footer(); ?>
