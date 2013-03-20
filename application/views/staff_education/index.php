<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2 class="rama-title">Listing Educations</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table">
        <thead>
            <tr>
                <th>Edu ID</th>
                <th>Education Year</th>
                <th>Education Gelar</th>
                <th>Education Name</th>
                <th width="10%" colspan="2" class="action_cell">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($educations as $row) {
        ?>
            <tr>
                <td><?php echo $row->edu_id; ?></td>
                <td><?php echo $row->edu_year; ?></td>
                <td><?php echo $row->edu_gelar; ?></td>
                <td><?php echo $row->edu_name; ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/educations/edit/' . $row->edu_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/educations/delete/' . $row->edu_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
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