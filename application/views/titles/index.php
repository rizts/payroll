<?php get_header(); ?>
<div class="wrap">
  <?php echo $this->session->flashdata('message'); ?>
    <h2 class="rama-title">Listing Title</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
          <tr>
              <th width="45%">Jab ID</th>
              <th width="45%">Jabatan</th>
              <th width="10%" colspan="2" class="action_cell">Action</th>
          </tr>
        </thead>
        <?php
        foreach ($title_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->title_id; ?></td>
                <td><?php echo $row->title_name; ?></td>
                <td class="action_cell"><?php echo anchor('titles/edit/' . $row->title_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('titles/delete/' . $row->title_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
        </div>

<?php get_footer(); ?>
