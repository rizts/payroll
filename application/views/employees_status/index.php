<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Employee Status</h2>
            <?php echo $this->session->flashdata('message'); ?>
            <table border="1">
                <tr>
                    <td>SK ID</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($es_list as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->sk_id; ?></td>
                        <td><?php echo $row->sk_name; ?></td>
                        <td>
                        <?php echo anchor('employees_status/edit/' . $row->sk_id, 'Edit'); ?>
                        <?php echo anchor('employees_status/delete/' . $row->sk_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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

