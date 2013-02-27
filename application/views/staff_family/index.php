<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Family</h2>
            <table border="1">
                <tr>
                    <td>Branch ID</td>
                    <td>Family Staff ID </td>
                    <td>Family Order</td>
                    <td>Family Name</td>
                    <td>Birthdate</td>
                    <td>Birthplace</td>
                    <td>Family Gender</td>
                    <td>Family Relation</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($families as $row) {
                ?>
                    <tr>
                        <td><?php echo $row->staff_fam_id; ?></td>
                        <td><?php echo $row->staff_fam_staff_id; ?></td>
                        <td><?php echo $row->staff_fam_order; ?></td>
                        <td><?php echo $row->staff_fam_name; ?></td>
                        <td><?php echo $row->staff_fam_bithdate; ?></td>
                        <td><?php echo $row->staff_fam_birthplace; ?></td>
                        <td><?php echo $row->staff_fam_sex; ?></td>
                        <td><?php echo $row->staff_fam_relation; ?></td>
                        <td>
                        <?php echo anchor('families/edit/' . $row->staff_fam_id, 'Edit'); ?>
                        <?php echo anchor('families/delete/' . $row->staff_fam_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this family?')")); ?>
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

