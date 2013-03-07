<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
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
                <?php echo anchor('staffs/' . $staff_id . '/educations/edit/' . $row->edu_id, 'Edit'); ?>
                <?php echo anchor('staffs/' . $staff_id . '/educations/delete/' . $row->edu_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
            </td>
        </tr>
        <?php
            }
        ?>
        </table>
        <br>
    <?php echo $pagination; ?>
            <br>
            <br>
    <?php echo $btn_add . " - " . $btn_home; ?>
        </div>
<?php get_footer(); ?>