<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Work History</h2>
            <table border="1">
                <tr>
                    <td>Edu ID</td>
                    <td>History Date</td>
                    <td>History Description</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($work_histories as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->history_id; ?></td>
                        <td><?php echo $row->history_date; ?></td>
                        <td><?php echo $row->history_description; ?></td>
                        <td>
                        <?php echo anchor('staff/'.$staff_id.'/work_histories/edit/' . $row->history_id, 'Edit'); ?>
                        <?php echo anchor('staff/'.$staff_id.'/work_histories/delete/' . $row->history_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
                </table>
            </div>
            <br>
        <?php echo $pagination; ?>
                    <br>
                    <br>
        <?php echo $btn_add . " - " . $btn_home; ?>
    </body>
</html> 

