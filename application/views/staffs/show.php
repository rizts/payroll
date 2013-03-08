<?php get_header(); ?>

<div class="wrap">
    <?php echo $this->breadcrumb->output(); ?>
    <div class="section section-small">
        <div class="section-header">
            <h4><?php echo $staff->staff_name; ?></h4>
            <div class="btn-toolbar section-actions">
                <div style="margin-top: -7px;" class="btn-group">
                    <?php echo anchor('staffs/edit/' . $staff->staff_id, 'Edit', array('class' => 'btn btn-primary')); ?>

                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <?php echo anchor('staffs/delete/' . $staff->staff_id, 'Delete'); ?>
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
                            <img width="100" src="/assets/images/User-icon.png" class="thumbnail" alt="<?php echo $staff->staff_name; ?>">
                        </div>

                        <div class="span10">
                            <div class="row-fluid">
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">N I K</h6>
                                        <h4>
                                            <?php echo $staff->staff_nik; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Title</h6>
                                        <h4>
                                            <?php echo $staff->staff_jabatan; ?>
                                        </h4>

                                    </div>
                                </div>
                                <div class="span1">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Status</h6>
                                        <h4>
                                            <?php echo $staff->staff_status_karyawan; ?>
                                        </h4>

                                    </div>
                                </div>
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Branch</h6>
                                        <h4>
                                            <?php echo $staff->staff_cabang; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Salary</h6>
                                        <h4>
                                            <?php echo "Rp. 0"; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Total Salary This Year</h6>
                                        <h4>
                                            <?php echo "Rp. 0"; ?>
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
                        <li><a href="#salary">Salary Component</a></li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade in active" id="general">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Absen Code</th>
                                        <td><?php echo $staff->staff_kode_absen; ?></td>
                                        <th>Phone Home</th>
                                        <td><?php echo $staff->staff_phone_home; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Marital</th>
                                        <td><?php echo $staff->staff_status_nikah; ?></td>
                                        <th>Phone HP</th>
                                        <td><?php echo $staff->staff_phone_hp; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthdate</th>
                                        <td><?php echo $staff->staff_birthdate; ?></td>
                                        <th>Email</th>
                                        <td><?php echo $staff->staff_email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Birthplace</th>
                                        <td><?php echo $staff->staff_birthplace; ?></td>
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
                                            <td>
                                                <div class="btn-group">
                                                <?php echo anchor('staffs/' . $family->staff_fam_staff_id . '/families/edit/' . $family->staff_fam_id, 'Edit', array('class' => 'btn btn-mini')); ?>
                                                <button type="button" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <?php echo anchor('staffs/' . $family->staff_fam_staff_id . '/families/delete/' . $family->staff_fam_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                                </tbody>
                                            </table>

                                            <div class="clearfix"></div>
                                            <p>
                                <?php echo anchor('staffs/' . $staff->staff_id . '/families/add', 'Add New Families', array('class' => 'btn btn-block btn-primary')); ?>
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
                                <?php echo anchor('staffs/' . $staff->staff_id . '/work_histories/add', 'Add New Works', array('class' => 'btn btn-block btn-primary')); ?>
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
                                <?php echo anchor('staffs/' . $staff->staff_id . '/medical_histories/add', 'Add New Medicals', array('class' => 'btn btn-block btn-primary')); ?>
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
                                <?php echo anchor('staffs/' . $staff->staff_id . '/educations/add', 'Add New Educations', array('class' => 'btn btn-block btn-primary')); ?>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="assets">
                                                <table class="table table-striped">
                                                    <tbody>
                                    <?php foreach ($asset_details as $asset) {
                                    ?>
                                                        <tr>
                                                            <td><?php echo $asset->descriptions; ?></td>
                                                            <td><?php echo $asset->assetd_status; ?></td>
                                                        </tr>
                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="tab-pane fade" id="salary">
                                            <table class="table table-striped">
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <div class="clearfix"></div>
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

                <script>
                    $(function() {
                        $('#myModalTest').on('click', function(){
                            var href = $(this).attr('href');
                            $('.modal-body').load(href,function(){
                                $(this).modal({
                                    keyboard:true,
                                    backdrop:true
                                });
                            }).modal('show');
                        });
                    });
                </script>
                <!-- Button to trigger modal -->

                <!--        <a href="http://payroll.me/index.php/staffs/1/work_histories/add" data-target="#myModal" role="button" class="btn" data-toggle="modal" id="myModalTest">Launch demo modal</a>        -->

                <!-- Modal -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Modal header</h3>
                    </div>
                    <div class="modal-body">
                        <p>Loading…</p>
                    </div>
                    <div class="modal-footer">
                        <button id="close" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </div>
<?php get_footer(); ?>