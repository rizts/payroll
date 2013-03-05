<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Title</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Jab ID</td>
            <td>Jabatan</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($title_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->title_id; ?></td>
                <td><?php echo $row->title_name; ?></td>
                <td>
                <?php echo anchor('titles/edit/' . $row->title_id, 'Edit'); ?>
                <?php echo anchor('titles/delete/' . $row->title_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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