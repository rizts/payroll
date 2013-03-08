<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2 class="rama-title">Listing Families</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Family ID</th>
                <th>Family Order</th>
                <th>Family Name</th>
                <th>Birthdate</th>
                <th>Birthplace</th>
                <th>Family Gender</th>
                <th>Family Relation</th>
                <th class="action_cell" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($families as $row) {
        ?>
            <tr>
                <td><?php echo $row->staff_fam_id; ?></td>
                <td><?php echo $row->staff_fam_order; ?></td>
                <td><?php echo $row->staff_fam_name; ?></td>
                <td><?php echo $row->staff_fam_birthdate; ?></td>
                <td><?php echo $row->staff_fam_birthplace; ?></td>
                <td><?php echo $row->staff_fam_sex; ?></td>
                <td><?php echo $row->staff_fam_relation; ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/families/edit/' . $row->staff_fam_id, img(array("src"=>assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('staffs/' . $staff_id . '/families/delete/' . $row->staff_fam_id, img(array("src"=>assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td>
        </tr>
        <?php
            }
        ?>
        </table>
        <br>
    <?php echo $pagination; ?>
        </div>
<?php get_footer(); ?>

