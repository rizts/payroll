<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Tax Status</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
          <tr>
              <th width="30%">SP ID</th>
              <th width="30%">SPK Status</th>
              <th width="30%">SPK PTKP</th>
              <th width="10%" colspan="2" class="action_cell">Action</th>
          </tr>
        </thead>
        <?php
        foreach ($tax_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sp_id; ?></td>
                <td><?php echo $row->sp_status; ?></td>
                <td><?php echo $row->sp_ptkp; ?></td>
                <td class="action_cell"><?php echo anchor('taxes_employees/edit/' . $row->sp_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('taxes_employees/delete/' . $row->sp_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
        </div>

<?php get_footer(); ?>
