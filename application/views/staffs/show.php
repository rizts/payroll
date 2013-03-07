<?php get_header(); ?>

<div class="wrap">

    <div class="section section-small">
        <div class="section-header">
            <h5>Employe</h5>
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
                <!--                <div class="span3" style="margin-top: -17px;">
                                    <ul class="nav nav-list bs-docs-sidenav affix">
                                        <li class="active"><?php echo anchor('staffs/show/' . $staff_id, '<i class="icon-chevron-right"></i> Overview</li>'); ?>
                                        <li class=""><?php echo anchor('staffs/' . $staff_id . '/families/index', '<i class="icon-chevron-right"></i> Families <span class="badge">0</span>'); ?></li>
                                        <li class=""><?php echo anchor('staffs/' . $staff_id . '/work_histories/index', '<i class="icon-chevron-right"></i> Work Histories <span class="badge">0</span>'); ?></li>
                                        <li class=""><?php echo anchor('staffs/' . $staff_id . '/educations/index', '<i class="icon-chevron-right"></i> Educations <span class="badge">0</span>'); ?></li>
                                        <li class=""><?php echo anchor('staffs/' . $staff_id . '/salaries/index', '<i class="icon-chevron-right"></i> Salaries <span class="badge">0</span>'); ?></li>
                                    </ul>
                                </div>-->
                <div class="span">
                    <div class="row-fluid">
                        <div class="span2 ac">
                            <img width="100" src="/assets/images/photon/user5.jpg" class="thumbnail" alt="<?php echo $staff_name; ?>">
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
                                <div class="span5">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Name</h6>
                                        <h4>
                                            <?php echo $staff_name; ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="span2">
                                    <div class="stat-block">
                                        <h6 class="stat-heading">Employe Status</h6>
                                        <h4>
                                            <?php echo $staff_status_karyawan; ?>
                                        </h4>

                                    </div>
                                </div>
                                <div class="span3">
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
                    </ul>

                    <div class="tab-content" id="myTabContent" style="margin-top: -20px;">
                        <div class="tab-pane fade in active" id="general">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <td><?php echo $staff_jabatan; ?></td>
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
                            <?php
                                            foreach ($families as $family) {
                                                echo $family->staff_fam_name;
                                            }
                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="works">
                                            Works
                                            <a class="btn" href="#" id="model_works">Add a Note</a>
                                        </div>
                                        <div class="tab-pane fade" id="medicals">
                                            Medicals
                                        </div>
                                        <div class="tab-pane fade" id="edications">
                                            Educations
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
                            $('#model_works').click(function (e){
                                $('#ModalFormNotes').modal('show');
                            });
                        })
                    </script>
                </div>

                <div id="ModalFormNotes" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Notes</h3>
                    </div>
                    <div class="modal-body">
                        <p>Loading..</p>
                    </div>
                </div>


<?php get_footer(); ?>