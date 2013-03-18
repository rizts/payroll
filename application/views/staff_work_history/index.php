<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2 class="rama-title">Listing Work History</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Edu ID</th>
                <th>History Date</th>
                <th>History Description</th>
                <th colspan="2" class="action_cell" width="10px">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($work_histories as $row) {
        ?>
            <tr>
                <td><?php echo $row->history_id; ?></td>
                <td><?php echo $row->history_date; ?></td>
                <td><?php echo $row->history_description; ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $row->staff_id . '/work_histories/edit/' . $row->history_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $row->staff_id . '/work_histories/delete/' . $row->history_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>

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