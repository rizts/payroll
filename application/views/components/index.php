<?php get_header(); ?>
<div class="wrap">
    <?php echo $this->session->flashdata('message'); ?>
    <h2 class="rama-title">Listing Component(Gaji)</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
          <tr>
              <th width="30%">Com ID</th>
              <th width="30%">Comp Name</th>
              <th width="30%">Comp Type</th>
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
                <td class="action_cell"><?php echo anchor('components/edit/' . $row->comp_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('components/delete/' . $row->comp_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
        </div>
<?php get_footer(); ?>
