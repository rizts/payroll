<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Asset</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Asset ID</td>
            <td>Asset Name</td>
            <td>Asset Status</td>
            <td>Staff ID</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($asset_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->asset_id; ?></td>
                <td><?php echo $row->asset_name; ?></td>
                <td><?php echo $row->asset_status; ?></td>
                <td><?php echo $row->staff_id; ?></td>
                <td><?php echo $row->date; ?></td>
                <td>
                <?php echo anchor('assets/' . $row->asset_id . '/details/add', 'Add Detail'); ?> |
                <?php echo anchor('assets/edit/' . $row->asset_id, 'Edit'); ?> |
                <?php echo anchor('assets/delete/' . $row->asset_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
            </td>
        </tr>
        <?php } ?>
        </table>

        <br>
    <?php echo $pagination; ?>
            <br>
            <br>
    <?php echo $btn_add . " - " . $btn_home; ?>
        </div>
<?php get_footer(); ?>
