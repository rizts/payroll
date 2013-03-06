<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Salary Component</h2>
    <table border="1">
        <tr>
            <td>Gaji ID</td>
            <td>Component ID</td>
            <td>Gaji Daily</td>
            <td>Gaji Amount</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($salary_components as $row) {
        ?>
            <tr>
                <td><?php echo $row->gaji_id; ?></td>
                <td><?php echo $row->gaji_component_id; ?></td>
                <td><?php echo $row->gaji_daily_value; ?></td>
                <td><?php echo $row->gaji_amount_value; ?></td>
                <td>
                <?php echo anchor('staffs/'.$row->staff_id.'/salary_components/edit/' . $row->gaji_id, 'Edit'); ?>
                <?php echo anchor('staffs/'.$row->staff_id.'/salary_components/delete/' . $row->gaji_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
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