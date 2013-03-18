<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2 class="rama-title">Listing Salary Component</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Gaji ID</th>
                <th>Component ID</th>
                <th>Gaji Daily</th>
                <th>Gaji Amount</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($salary_components as $row) {
        ?>
            <tr>
                <td><?php echo $row->gaji_id; ?></td>
                <td><?php echo $row->gaji_component_id; ?></td>
                <td><?php echo rupiah($row->gaji_daily_value); ?></td>
                <td><?php echo rupiah($row->gaji_amount_value); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $row->staff_id . '/salary_components/edit/' . $row->gaji_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $row->staff_id . '/salary_components/delete/' . $row->gaji_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="clearfix"></div>
    <br>
    <div class="pagination pagination-right">
        <ul>
            <?php echo $pagination; ?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>