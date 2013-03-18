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
//            "plugins/jquery.pnotify.min.js",
            "bootstrap/bootstrap.min.js",
            "plugins/less-1.3.1.min.js",
            "plugins/xbreadcrumbs.js",
//            "plugins/jquery.maskedinput-1.3.min.js",
//            "plugins/jquery.autotab-1.1b.js",
//            "plugins/charCount.js",
//            "plugins/jquery.textareaCounter.js",
//            "plugins/elrte.min.js",
//            "plugins/elrte.en.js",
//            "plugins/select2.js",
//            "plugins/jquery-picklist.min.js",
//            "plugins/jquery.validate.min.js",
//            "plugins/additional-methods.min.js",
//            "plugins/jquery.form.js",
//            "plugins/jquery.metadata.js",
//            "plugins/jquery.mockjax.js",
//            "plugins/jquery.uniform.min.js",
//            "plugins/jquery.tagsinput.min.js",
//            "plugins/jquery.rating.pack.js",
//            "plugins/farbtastic.js",
//            "plugins/jquery.timeentry.min.js",
//            "plugins/jquery.dataTables.min.js",
            "plugins/jquery.jstree.js",
//            "plugins/dataTables.bootstrap.js",
            "plugins/jquery.mousewheel.min.js",
//            "plugins/jquery.mCustomScrollbar.js",
//            "plugins/jquery.flot.js",
//            "plugins/jquery.flot.stack.js",
//            "plugins/jquery.flot.pie.js",
//            "plugins/jquery.flot.resize.js",
//            "plugins/raphael.2.1.0.min.js",
//            "plugins/justgage.1.0.1.min.js",
//            "plugins/jquery.countdown.js",
//            "plugins/jquery.cookie.js",
//            "plugins/bootstrap-fileupload.min.js",
//            "plugins/prettify/prettify.js",
//            "blackify.js",
//            "common.js"
        ));
        ?>

        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>                
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/docs.css"/>
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
                            <?php echo $branch == true ? '<li>' . anchor('branches', 'Branch') . '</li>' : ''; ?>
                            <?php echo $departement == true ? '<li>' . anchor('departments', 'Departements') . '</li>' : ''; ?>
                            <?php echo $tax_employee == true ? '<li>' . anchor('taxes_employees', 'Taxes Employees') . '</li>' : ''; ?>
                            <?php echo $employee_status == true ? '<li>' . anchor('employees_status', 'Employees Status') . '</li>' : ''; ?>
                            <?php echo $marital_status == true ? '<li>' . anchor('maritals_status', 'Marital Status') . '</li>' : ''; ?>
                            <?php echo $title == true ? '<li>' . anchor('titles', 'Title') . '</li>' : ''; ?>
                            <?php echo $component == true ? '<li>' . anchor('components', 'Component(Gaji)') . '</li>' : ''; ?>
                            <?php echo $salary == true ? '<li>' . anchor('salaries', 'Salary') . '</li>' : ''; ?>
                            <?php echo $staff == true ? '<li>' . anchor('staffs', 'Staff') . '</li>' : ''; ?>
                            <?php echo $assets == true ? '<li>' . anchor('assets', 'Assets') . '</li>' : ''; ?>
                            <?php echo $users == true ? '<li>' . anchor('users/index', 'Users') . '</li>' : ''; ?>
                            <?php echo $role_details == true ? '<li>' . anchor('users/roles', 'Roles') . '</li>' : ''; ?>
                            <?php echo '<li>' . anchor('users/logout', 'Logout (' . $this->session->userdata('username') . ')') . '</li>'; ?>
                        </ul>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
