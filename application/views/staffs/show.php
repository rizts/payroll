<?php get_header(); ?>

<div class="wrap">

    <div class="section section-small">
        <div class="section-header">
            <h5>Data Detail Staff</h5>
            <div class="btn-toolbar section-actions">
                <div style="margin-top: -7px;" class="btn-group">
                    <?php echo anchor('staffs/edit/' . $staff_id, 'Edit', array('class' => 'btn btn-primary')); ?>

                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <?php echo anchor('staffs/delete/' . $staff_id, 'Delete'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row-fluid">
                <div class="span">
                    <div class="row-fluid">
                        <div class="span2 ac">
                            <img width="100" src="/assets/images/User-icon.png" class="thumbnail" alt="<?php echo $staff_name; ?>">
                        </div>

                        <div class="span10">
                            <div class="row-fluid">
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">N I K</h6>
                                        <h4>
                                            <?php echo $staff_nik; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Name</h6>
                                        <h4>
                                            <?php echo $staff_name; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Title</h6>
                                        <h4>
                                            <?php echo $staff_jabatan; ?>
                                        </h4>

                                    </div>
                                </div>
                                <div class="span1">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Status</h6>
                                        <h4>
                                            <?php echo $staff_status_karyawan; ?>
                                        </h4>

                                    </div>
                                </div>
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Branch</h6>
                                        <h4>
                                            <?php echo $staff_cabang; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 10px;" class="well well-small">
                        <div class="btn-toolbar ac">
                            <div class="btn-group">
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#general">General</a></li>
                        <li><a href="#families">Families</a></li>
                        <li><a href="#works">Work Histories</a></li>
                        <li><a href="#medicals">Medical Histories</a></li>
                        <li><a href="#educations">Educations</a></li>
                        <li><a href="#assets">Assets</a></li>
                    </ul>

                    <div class="tab-content" id="myTabContent" style="margin-top: -20px;">
                        <div class="tab-pane fade in active" id="general">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Absen Code</th>
                                        <td><?php echo $staff_kode_absen; ?></td>
                                        <th>Phone Home</th>
                                        <td><?php echo $staff_phone_home; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Marital</th>
                                        <td><?php echo $staff_status_nikah; ?></td>
                                        <th>Phone HP</th>
                                        <td><?php echo $staff_phone_hp; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthdate</th>
                                        <td><?php echo $staff_birthdate; ?></td>
                                        <th>Email</th>
                                        <td><?php echo $staff_email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthplace</th>
                                        <td><?php echo $staff_birthplace; ?></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane fade" id="families">
                            <table class="table table-striped">
                                <tbody>
                                    <?php foreach ($families as $family) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $family->staff_fam_order; ?></td>
                                                    <td><?php echo $family->staff_fam_name; ?></td>
                                                    <td>
                                            <?php
                                                echo $family->staff_fam_birthplace . ', ' . $family->staff_fam_birthdate;
                                            ?>
                                            </td>
                                            <td><?php echo $family->staff_fam_sex; ?></td>
                                            <td><?php echo $family->staff_fam_relation; ?></td>
                                        </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    <p>
                                <?php echo anchor('staffs/' . $staff_id . '/work_histories/add', 'Add New Families', array('class' => 'btn btn-block btn-primary')); ?>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="works">
                                        <table class="table table-striped">
                                            <tbody>
                                    <?php foreach ($works as $work) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $work->history_date ?></td>
                                                    <td><?php echo $work->history_description ?></td>
                                                </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <p>
                                <?php echo anchor('staffs/' . $staff_id . '/work_histories/add', 'Add New Works', array('class' => 'btn btn-block btn-primary')); ?>
                                        </p>

                                    </div>
                                    <div class="tab-pane fade" id="medicals">
                                        <table class="table table-striped">
                                            <tbody>
                                    <?php foreach ($medicals as $medic) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $medic->medic_date ?></td>
                                                    <td><?php echo $medic->medic_description ?></td>
                                                </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <p>
                                <?php echo anchor('staffs/' . $staff_id . '/medical_histories/add', 'Add New Medicals', array('class' => 'btn btn-block btn-primary')); ?>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="educations">
                                        <table class="table table-striped">
                                            <tbody>
                                    <?php foreach ($educations as $education) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $education->edu_year; ?></td>
                                                    <td><?php echo $education->edu_gelar; ?></td>
                                                    <td><?php echo $education->edu_name; ?></td>
                                                </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <p>
                                <?php echo anchor('staffs/' . $staff_id . '/educations/add', 'Add New Educations', array('class' => 'btn btn-block btn-primary')); ?>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="assets">
                                        Assets
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $('#myTab a').click(function (e) {
                            e.preventDefault();
                            $(this).tab('show');
                        });
                    })
                </script>
            </div>
            
<?php get_footer(); ?>