<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Branch</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
          <tr>
              <th width="45%">Branch ID</th>
              <th width="45%">Branch Name</th>
              <th width="10%" colspan="2" class="action_cell">Action</th>
          </tr>
        </thead>
        <?php
        foreach ($branch_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->branch_id; ?></td>
                <td><?php echo $row->branch_name; ?></td>
                <td class="action_cell"><?php echo anchor('branches/edit/' . $row->branch_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('branches/delete/' . $row->branch_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
            <br>
            <br>
        </div>
<?php get_footer(); ?>
