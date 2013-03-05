<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Marital Status</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>SN ID</td>
            <td>Status Nikah</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($marital_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->sn_id; ?></td>
                <td><?php echo $row->sn_name; ?></td>
                <td>
                <?php echo anchor('maritals_status/edit/' . $row->sn_id, 'Edit'); ?>
                <?php echo anchor('maritals_status/delete/' . $row->sn_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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