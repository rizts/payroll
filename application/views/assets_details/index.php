<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Asset Detail</h2>
            <?php echo $this->session->flashdata('message'); ?>
            <table border="1">
                <tr>
                    <td>Date</td>
                    <td>Staff</td>
                    <td>Descriptions</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($assets_details as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->staff_id; ?></td>
                        <td><?php echo $row->descriptions; ?></td>
                        <td><?php echo $row->assetd_status == 1 ? 'Enable' : 'Disable'; ?></td>
                        <td>
                        <?php echo anchor('assets/' .$row->asset_id.'/details/add', 'Add Detail'); ?> |
                        <?php echo anchor('assets/' . $row->asset_id.'/details/edit/'.$row->assetd_id, 'Edit'); ?> |
                        <?php echo anchor('assets/' . $row->asset_id.'/details/delete/'.$row->assetd_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
                    </td>
                </tr>
                <?php } ?>
                </table>
            </div>
            <br>
        <?php echo $pagination; ?>
                    <br>
                    <br>
        <?php echo $btn_add . " - " . $btn_home; ?>
    </body>
</html>

