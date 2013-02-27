<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Status Pajak Karyawan</h2>
            <table border="1">
                <tr>
                    <td>SP ID</td>
                    <td>SPK Status</td>
                    <td>SPK PTKP</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($status_pajak_karyawan as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->sp_id; ?></td>
                        <td><?php echo $row->sp_status; ?></td>
                        <td><?php echo $row->sp_ptkp; ?></td>
                        <td>
                        <?php echo anchor('status_pajak_karyawan/edit/' . $row->sp_id, 'Edit'); ?>
                        <?php echo anchor('status_pajak_karyawan/delete/' . $row->sp_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this SPK?')")); ?>

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

