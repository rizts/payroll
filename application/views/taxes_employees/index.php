<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Tax Employees</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>SP ID</td>
            <td>SPK Status</td>
            <td>SPK PTKP</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($tax_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sp_id; ?></td>
                <td><?php echo $row->sp_status; ?></td>
                <td><?php echo $row->sp_ptkp; ?></td>
                <td>
                <?php echo anchor('taxes_employees/edit/' . $row->sp_id, 'Edit'); ?>
                <?php echo anchor('taxes_employees/delete/' . $row->sp_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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