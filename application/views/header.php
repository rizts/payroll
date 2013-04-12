<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Payroll</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fullcalendar.css"/>

        <?php
        echo load_css(array(
            "stylesheets.css",
            "dashboard.css",
            "bootstrapSwitch.css",
            "jquery.alerts.css",
            "iphone-style.css",
            "mcustomscrollbar/mCustomScrollbar.css",
            "jquery.handsontable.full.css"
        ));
        echo load_js(array(
            "plugins/jquery/jquery-1.9.1.min.js",
            "plugins/jquery/jquery-ui-1.10.1.custom.min.js",
            "plugins/jquery/jquery-migrate-1.1.1.min.js",
            "plugins/jquery/globalize.js",
            "plugins/other/excanvas.js",
            "plugins/other/jquery.mousewheel.min.js",
            "plugins/bootstrap/bootstrap.min.js",
            "bootstrap-modal.js",
            "bootstrap-modalmanager.js",
            "bootstrapSwitch.js",
            "plugins/cookies/jquery.cookies.2.2.0.min.js", // used by navigation menu
            "plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js",
            "plugins/validationEngine/languages/jquery.validationEngine-en.js",
            "plugins/validationEngine/jquery.validationEngine.js",
            "plugins/uniform/jquery.uniform.min.js",
            "plugins/select/select2.min.js",
            "plugins/maskedinput/jquery.maskedinput-1.3.min.js",
            "colResizable-1.3.med.js",
            "jquery.alerts.js",
            "iphone-style-checkboxes.js",
            "jquery.editable-1.3.3.js",
            "jquery.number.min.js",
            "jquery.handsontable.full.js",
            "plugins/jquery.jstree.js",
            "accounting.js",
            "plugins.js",
//            "charts.js",
            "actions.js",
            "custom.js"
        ));
        ?>

        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>                
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/docs.css"/>
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar">
                <div class="nContainer">
                    <div style="padding: 5px;">
                        <?php
                            $setting = new Setting();                            
                        ?>
                        <div><img src="<?php echo assets_url('upload/' . $setting->get_val('logo')) ?>" style="width: 216px; height: 100px;" /></div>
                        <div style="font-size: 20px; padding: 5px; color: #fff; font-weight: bold;">
                            <?php echo $setting->get_val('company_name'); ?>
                        </div>
                        <form action="<?php echo site_url('searches')?> " method="get">
                            <input autofocus="autofocus" type="text" name="q" placeholder="Search Advance" style="width: 215px;">
                        </form>
                    </div>
                    <ul class="navigation">
                        <li><?php echo anchor("/", "Dashboard"); ?></li>
                        <li>
                            <a href="#" class="blblue">HRD</a>
                            <div class="open"></div>
                            <ul>
                                <?php
                                if ($this->session->userdata('logged_in') == true) {
                                    $user = new User();
                                    $role_id = $this->session->userdata('sess_role_id');
                                    $branch = $user->exist_module($role_id, 'Branch');
                                    $departement = $user->exist_module($role_id, 'Departement');
                                    $tax_employee = $user->exist_module($role_id, 'Tax_Employee');
                                    $employee_status = $user->exist_module($role_id, 'Employee_Status');
                                    $marital_status = $user->exist_module($role_id, 'Marital_Status');
                                    $title = $user->exist_module($role_id, 'Title');
                                    $component = $user->exist_module($role_id, 'Component');
                                    $salary = $user->exist_module($role_id, 'Salary');
                                    $staff = $user->exist_module($role_id, 'Staff');
                                    $assets = $user->exist_module($role_id, 'Assets');
                                    $users = $user->exist_module($role_id, 'Users');
                                    $role_details = $user->exist_module($role_id, 'Role_Details');
                                ?>
                                    <ul class="nav">
                                    <?php echo $salary == true ? '<li>' . anchor('salaries', 'Salary') . '</li>' : ''; ?>
                                    <?php echo $staff == true ? '<li>' . anchor('staffs', 'Staff') . '</li>' : ''; ?>
                                    <?php echo $assets == true ? '<li>' . anchor('assets', 'Assets') . '</li>' : ''; ?>
                                    <li><?php echo anchor('absensi', 'Absensi')?></li>
                                </ul>
                                <?php } ?>
                            </ul>
                        <li>
                            <a href="#" class="blgreen">CONFIG</a>
                            <div class="open"></div>
                            <ul class="nav">
                                <?php echo $branch == true ? '<li>' . anchor('branches', 'Branch') . '</li>' : ''; ?>
                                <?php echo $departement == true ? '<li>' . anchor('departments', 'Departements') . '</li>' : ''; ?>
                                <?php echo $tax_employee == true ? '<li>' . anchor('taxes_employees', 'Taxes Employees') . '</li>' : ''; ?>
                                <?php echo $employee_status == true ? '<li>' . anchor('employees_status', 'Employees Status') . '</li>' : ''; ?>
                                <?php echo $marital_status == true ? '<li>' . anchor('maritals_status', 'Marital Status') . '</li>' : ''; ?>
                                <?php echo $title == true ? '<li>' . anchor('titles', 'Title') . '</li>' : ''; ?>
                                <?php echo $component == true ? '<li>' . anchor('components', 'Component(Gaji)') . '</li>' : ''; ?>
                                <?php echo $users == true ? '<li>' . anchor('users/index', 'Users') . '</li>' : ''; ?>
                                <?php echo $role_details == true ? '<li>' . anchor('users/roles', 'Roles') . '</li>' : ''; ?>
                                <?php echo $role_details == true ? '<li>' . anchor('settings', 'Settings') . '</li>' : ''; ?>
                            </ul>
                        </li>

                        <li>
                            <?php echo anchor('users/logout', 'Logout (' . $this->session->userdata('username') . ')', "class='blred'"); ?>
                        </li>
                        </li>
                    </ul>
                </div><!-- // nContainer -->
                <div class="widget">
                    <div class="datepicker"></div>
                </div>
            </div>

