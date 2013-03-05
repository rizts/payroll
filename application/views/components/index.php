<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Component(Gaji)</h2>
    <table border="1">
        <tr>
            <td>Com ID</td>
            <td>Comp Name</td>
            <td>Comp Type</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($components as $row) {
        ?>
            <tr>
                <td><?php echo $row->comp_id; ?></td>
                <td><?php echo $row->comp_name; ?></td>
                <td><?php echo $row->comp_type; ?></td>
                <td>
                <?php echo anchor('components/edit/' . $row->comp_id, 'Edit'); ?>
                <?php echo anchor('components/delete/' . $row->comp_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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