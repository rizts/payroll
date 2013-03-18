<?php get_header(); ?>
<script type='text/javascript'>

    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            events: '<?php echo site_url('staffs/hut_reminders'); ?>',
            editable: true,
            eventDrop: function(event, delta) {
                alert(event.title + ' was moved ' + delta + ' days\n' +
                    '(should probably update your database)');
            }
        });
    });

</script>

<div class="wrap">
    <?php echo $this->session->flashdata('message'); ?>    
    <div class="row">       
        <div class="span6">
            <div class="row-fluid">
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
                                        <td width="10">
                                            <div class="btn-group">
                                            <?php echo anchor('staffs/edit/' . $staff->staff_id, 'Edit', array('class' => 'btn btn-mini')); ?>
                                            <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown" type="button">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li><?php echo anchor('staffs/delete/' . $staff->staff_id, '<i class="icon-trash"></i> Destroy', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
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



                        <div class="section section-small">
                            <div class="section-header">
                                <h5>Statistic</h5>
                            </div>
                            <div class="section-content">
                                <p>
                                <div id="container_chart"></div>
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="span6">
                        <div class="section section-small">
                            <div class="section-header">
                                <h5>HUT Reminders</h5>
                            </div>
                            <div class="section-content">
                                <p>
                                <div id="calendar"></div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row -->

            </div>
<?php get_footer(); ?>