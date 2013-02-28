<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Education</h2>
            <table border="1">
                <tr>
                    <td>Edu ID</td>
                    <td>Education Year</td>
                    <td>Education Gelar</td>
                    <td>Education Name</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($educations as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->edu_id; ?></td>
                        <td><?php echo $row->edu_year; ?></td>
                        <td><?php echo $row->edu_gelar; ?></td>
                        <td><?php echo $row->edu_name; ?></td>
                        <td>
                        <?php echo anchor('staff/'.$staff_id.'/educations/edit/' . $row->edu_id, 'Edit'); ?>
                        <?php echo anchor('staff/'.$staff_id.'/educations/delete/' . $row->edu_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this education?')")); ?>
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

