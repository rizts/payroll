<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Branch</h2>
            <table border="1">
                <tr>
                    <td>Branch ID</td>
                    <td>Branch Name</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($branch_list as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->branch_id; ?></td>
                        <td><?php echo $row->branch_name; ?></td>
                        <td>
                        <?php echo anchor('branches/edit/' . $row->branch_id, 'Edit'); ?>
                        <?php echo anchor('branches/delete/' . $row->branch_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this branchhu?')")); ?>

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

