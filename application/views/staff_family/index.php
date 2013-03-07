<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2>Listing Family</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Branch ID</td>
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
                <td><?php echo $row->staff_fam_order; ?></td>
                <td><?php echo $row->staff_fam_name; ?></td>
                <td><?php echo $row->staff_fam_birthdate; ?></td>
                <td><?php echo $row->staff_fam_birthplace; ?></td>
                <td><?php echo $row->staff_fam_sex; ?></td>
                <td><?php echo $row->staff_fam_relation; ?></td>
                <td>
                <?php echo anchor('staffs/' . $staff_id . '/families/edit/' . $row->staff_fam_id, 'Edit'); ?>
                <?php echo anchor('staffs/' . $staff_id . '/families/delete/' . $row->staff_fam_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
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

