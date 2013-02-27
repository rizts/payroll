<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Jabatan</h2>
            <table border="1">
                <tr>
                    <td>Jab ID</td>
                    <td>Jabatan</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($jabatan as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->title_id; ?></td>
                        <td><?php echo $row->title_name; ?></td>
                        <td>
                        <?php echo anchor('jabatan/edit/' . $row->title_id, 'Edit'); ?>
                        <?php echo anchor('jabatan/delete/' . $row->title_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this jabatan?')")); ?>

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

