<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Departement</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Dept ID</td>
            <td>Departement Name</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($dept_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->dept_id; ?></td>
                <td><?php echo $row->dept_name; ?></td>
                <td>
                <?php echo anchor('departments/edit/' . $row->dept_id, 'Edit'); ?>
                <?php echo anchor('departments/delete/' . $row->dept_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

            </td>
        </tr>
        <?php } ?>
        </table>

        <br>
    <?php echo $pagination; ?>
            <br>
            <br>
    <?php echo $btn_add . " - " . $btn_home; ?>
        </div>
<?php get_footer(); ?>