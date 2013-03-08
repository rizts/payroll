<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Sub Salaries</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Salary ID</th>
                <th>Salary Periode</th>
                <th>Salary Daily Value</th>
                <th>Salary Amount Value</th>
                <th class="action_cell" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($sub_salaries as $row) {
        ?>
            <tr>
                <td><?php echo $row->salary_id; ?></td>
                <td><?php echo $row->salary_periode; ?></td>
                <td><?php echo rupiah($row->salary_daily_value); ?></td>
                <td><?php echo rupiah($row->salary_amount_value); ?></td>
                <td class="action_cell"><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/edit/' . $row->sub_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/delete/' . $row->sub_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php } ?>
        </table>
        <br>
    <?php echo $pagination; ?>
        </div>
<?php get_footer(); ?>