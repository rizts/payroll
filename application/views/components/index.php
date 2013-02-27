<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Component(Gaji)</h2>
            <table border="1">
                <tr>
                    <td>Com ID</td>
                    <td>Comp Name</td>
                    <td>Comp Type</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($components as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->comp_id; ?></td>
                        <td><?php echo $row->comp_name; ?></td>
                        <td><?php echo $row->comp_type; ?></td>
                        <td>
                        <?php echo anchor('components/edit/' . $row->comp_id, 'Edit'); ?>
                        <?php echo anchor('components/delete/' . $row->comp_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this gaji?')")); ?>

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

