<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Role Detail</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Roled ID</th>
                <th>Roled Module</th>
                <th>Roled Add</th>
                <th>Roled Edit</th>
                <th>Roled Delete</th>
                <th>Roled Approval</th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($roled_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->roled_id; ?></td>
                <td><?php echo $row->roled_module; ?></td>
                <td><?php echo $row->roled_add; ?></td>
                <td><?php echo $row->roled_edit; ?></td>
                <td><?php echo $row->roled_delete; ?></td>
                <td><?php echo $row->roled_approval; ?></td>
                <td class="action_cell"><?php echo anchor('users/roles/' . $role_id . '/role_details/edit', img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('branches/delete/' . $row->branch_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>