<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <table>
            <tr>
                <td>Asset Name</td>
                <td><?php echo form_input($asset_name); ?></td>
            </tr>
            <tr>
                <td>Asset Status</td>
                <td><?php echo $asset_status; ?></td>
            </tr>
            <tr>
                <td>Staff ID</td>
                <td><?php echo form_input($staff_id); ?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?php echo form_input($date); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit($btn_save); ?></td>
            </tr>
        </table>
        <?php echo form_close() ?>

        <br>
        <?php echo $link_back; ?>
    </body>

</html>

