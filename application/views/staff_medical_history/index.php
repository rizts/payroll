<?php get_header(); ?>
<div class="wrap">
    <?php echo $this->session->flashdata('message'); ?>
    <h2>Listing Medical History</h2>
    <table border="1">
        <tr>
            <td>Medic ID</td>
            <td>Medical Date</td>
            <td>Medical Description</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($medical_histories as $row) {
        ?>
            <tr>
                <td><?php echo $row->medic_id; ?></td>
                <td><?php echo $row->medic_date; ?></td>
                <td><?php echo $row->medic_description; ?></td>
                <td>
                <?php echo anchor('staffs/' . $row->staff_id . '/medical_histories/edit/' . $row->medic_id, 'Edit'); ?>
                <?php echo anchor('staffs/' . $row->staff_id . '/medical_histories/delete/' . $row->medic_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
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
