<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Departement</h2>
            <table border="1">
                <tr>
                    <td>Dept ID</td>
                    <td>Departement Name</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($departements as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->dept_id; ?></td>
                        <td><?php echo $row->dept_name; ?></td>
                        <td>
                        <?php echo anchor('departements/edit/' . $row->dept_id, 'Edit'); ?>
                        <?php echo anchor('departements/delete/' . $row->dept_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this departement?')")); ?>

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

