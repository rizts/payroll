<?php get_header(); ?>
<div class="wrap">
    <div class="row">
        <div class="span7">
            <div class="section section-small">
                <div class="section-header">
                    <h5>
                        Employes
                        <small>
                            (<?php echo $staff_count; ?>)
                        </small>
                    </h5>
                </div>
                <div class="section-content">
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($staffs as $staff) {
                            ?>
                                <tr>
                                    <td><?php echo anchor('staffs/show/' . $staff->staff_id, $staff->staff_name); ?></td>
                                    <td><span class="label">Phone</span> <?php echo $staff->staff_phone_hp; ?></td>
                                    <td><span class="label"><?php echo $staff->staff_jabatan; ?></span></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="icon-cog"></i>
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                <?php echo anchor('staffs/edit/' . $staff->staff_id, '<i class="icon-pencil"></i> Edit'); ?>
                                            </li>
                                            <li>
                                                <?php echo anchor('staffs/delete/' . $staff->staff_id, '<i class="icon-trash"></i> Destroy', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div style="clear: both;"></div>
                                    <p style="margin-top: 20px;">
                        <?php echo $btn_new_staff; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="span5">
                                <div class="section section-small">
                                    <div class="section-header">
                                        <h5>Calendar Reminders</h5>
                                    </div>
                                    <div class="section-content">
                                        <p>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php get_footer(); ?>