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

        $(function () {
            $('#container_chart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Branches'
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr'
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Count Eployees'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} em</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Bandung',
                        data: [49.9, 71.5, 106.4, 129.2]

                    }, {
                        name: 'Jakarta',
                        data: [83.6, 78.8, 98.5, 93.4]

                    }, {
                        name: 'Surabaya',
                        data: [48.9, 38.8, 39.3, 41.4]

                    }, {
                        name: 'Bali',
                        data: [42.4, 33.2, 34.5, 39.7]

                    }]
            });
        });
    });

</script>

<div class="body">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="content" style="padding-top: 0;">
        <div class="page-header">
            <h3>Welcome (<?php echo $this->session->userdata('username'); ?>)</h3>
        </div>
        <br class="cl" />
        <div class="section section-small">
            <div class="section-header">
                <h5>
                    Employes
                    <small>
                        (<?php echo $staff_count; ?>)
                    </small>
                </h5>
                <div style="float:right"><?php echo $btn_new_staff; ?></div>
            </div>
            <div class="section-content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="40%">Name</th>
                            <th width="30%">Phone</th>
                            <th width="20%">Title</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
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
                                    <?php echo anchor('staffs/edit/' . $staff->staff_id, 'Edit', array('class' => 'btn btn-mini', 'style' => 'margin:0')); ?>
                                    <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown" type="button" style="margin:0">
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
                    </div>
                    <br class="cl" />
                </div>

                <!-- statistic -->
                <div class="one_half">
                    <div class="section section-small">
                        <div class="section-header">
                            <h5>Statistic</h5>
                        </div>
                        <div class="section-content">
                            <p><div id="container_chart"></div></p>
                        </div>
                    </div>
                </div>

                <!-- hut reminder -->
                <div class="one_half lastcolumn">
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

            </div>
        </div>
<?php get_footer(); ?>
