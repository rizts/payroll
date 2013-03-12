<?php get_header(); ?>
<div class="wrap">

    <?php echo $breadcrumb; ?>
    <h2>Listing Work History</h2> 
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Edu ID</th>
                <th>History Date</th>
                <th>History Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($work_histories as $row) {
        ?>
            <tr>
                <td><?php echo $row->history_id; ?></td>
                <td><?php echo $row->history_date; ?></td>
                <td><?php echo $row->history_description; ?></td>
                <td>
                <?php echo anchor('staffs/' . $row->staff_id . '/work_histories/edit/' . $row->history_id, 'Edit'); ?>
                <?php echo anchor('staffs/' . $row->staff_id . '/work_histories/delete/' . $row->history_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
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