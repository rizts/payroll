<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Sub Salaries</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Salary ID</td>
            <td>Salary Periode</td>
            <td>Salary Daily Value</td>
            <td>Salary Amount Value</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($sub_salaries as $row) {
        ?>
            <tr>
                <td><?php echo $row->salary_id; ?></td>
                <td><?php echo $row->salary_periode; ?></td>
                <td><?php echo $row->salary_daily_value; ?></td>
                <td><?php echo $row->salary_amount_value; ?></td>
                <td>
                <?php echo anchor('salaries/'.$row->salary_id.'/sub_salaries/edit/' . $row->sub_id, 'Edit'); ?>
                <?php echo anchor('salaries/'.$row->salary_id.'/sub_salaries/delete/' . $row->sub_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>

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