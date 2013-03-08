<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Sub Asset</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Staff</th>
                <th>Descriptions</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($assets_details as $row) {
        ?>
            <tr>
                <td><?php echo $row->date; ?></td>
                <td><?php echo $row->staff_id; ?></td>
                <td><?php echo $row->descriptions; ?></td>
                <td><?php echo $row->assetd_status == 1 ? 'Enable' : 'Disable'; ?></td>
                <td>
                <?php echo anchor('assets/' . $row->asset_id . '/details/edit/' . $row->assetd_id, 'Edit'); ?> |
                <?php echo anchor('assets/' . $row->asset_id . '/details/delete/' . $row->assetd_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
            </td>
        </tr>
        <?php } ?>
        </table>

        <br>
    <?php echo $pagination; ?>
        </div>
<?php get_footer(); ?>