<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Payroll</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fullcalendar.css"/>
        <?php
        echo load_css(array(
            "css_compiled/photon-min.css",
            "css_compiled/photon-min-part2.css",
            "css_compiled/photon-responsive-min.css",
            "dashboard.css",
            "boo.css"
        ));
        echo load_javascript(array(
            "jquery.min.js",
            "jquery-ui.min.js",
            "plugins/jquery.pnotify.min.js",
            "bootstrap/bootstrap.min.js",
            "plugins/less-1.3.1.min.js",
            "plugins/xbreadcrumbs.js",
            "plugins/jquery.maskedinput-1.3.min.js",
            "plugins/jquery.autotab-1.1b.js",
            "plugins/charCount.js",
            "plugins/jquery.textareaCounter.js",
            "plugins/elrte.min.js",
            "plugins/elrte.en.js",
            "plugins/select2.js",
            "plugins/jquery-picklist.min.js",
            "plugins/jquery.validate.min.js",
            "plugins/additional-methods.min.js",
            "plugins/jquery.form.js",
            "plugins/jquery.metadata.js",
            "plugins/jquery.mockjax.js",
            "plugins/jquery.uniform.min.js",
            "plugins/jquery.tagsinput.min.js",
            "plugins/jquery.rating.pack.js",
            "plugins/farbtastic.js",
            "plugins/jquery.timeentry.min.js",
            "plugins/jquery.dataTables.min.js",
            "plugins/jquery.jstree.js",
            "plugins/dataTables.bootstrap.js",
            "plugins/jquery.mousewheel.min.js",
            "plugins/jquery.mCustomScrollbar.js",
            "plugins/jquery.flot.js",
            "plugins/jquery.flot.stack.js",
            "plugins/jquery.flot.pie.js",
            "plugins/jquery.flot.resize.js",
            "plugins/raphael.2.1.0.min.js",
            "plugins/justgage.1.0.1.min.js",
            "plugins/jquery.countdown.js",
            "plugins/jquery.cookie.js",
            "plugins/bootstrap-fileupload.min.js",
            "plugins/prettify/prettify.js",
            "blackify.js",
            "common.js"
        ));
        ?>

        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        
        <!-- Bootstrap loaded by boo.css -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css"/> -->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.css"/>-->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/docs.css"/>-->
        

    </head>
    <body>
        <div class="nav-fixed-left">
            <ul class="nav nav-side-menu">
                <li>
                    <a href="<?php echo base_url(); ?>" class="sub-nav-container">
                        <i class="icon-photon book_alt"></i>
                        <span class="nav-selection">HRD</span>
                    </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            <li><?php echo anchor('branches', 'Branch'); ?></li>
                            <li><?php echo anchor('departments', 'Departements'); ?></li>
                            <li><?php echo anchor('taxes_employees', 'Taxes Employees'); ?></li>
                            <li><?php echo anchor('employees_status', 'Employees Status'); ?></li>
                            <li><?php echo anchor('maritals_status', 'Marital Status'); ?></li>
                            <li><?php echo anchor('titles', 'Title'); ?></li>
                            <li><?php echo anchor('components', 'Component(Gaji)'); ?></li>
                            <li><?php echo anchor('salaries', 'Salary'); ?></li>
                            <li><?php echo anchor('staffs', 'Staff'); ?></li>
                            <li><?php echo anchor('assets', 'Assets'); ?></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
