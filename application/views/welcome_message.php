<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Payroll</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to Payroll</h1>

            <div id="body">
                <ul>
                    <li>Master
                        <ul>
                            <li><?php echo anchor('branches', 'Branch'); ?></li>
                            <li><?php echo anchor('departements', 'Departements'); ?></li>
                            <li><?php echo anchor('status_pajak_karyawan', 'Status Pajak Karyawan'); ?></li>
                            <li><?php echo anchor('status_karyawan', 'Status Karyawan'); ?></li>
                            <li><?php echo anchor('status_nikah', 'Status Nikah'); ?></li>
                            <li><?php echo anchor('jabatan', 'Jabatan'); ?></li>
                            <li><?php echo anchor('gaji', 'Component(Gaji)'); ?></li>
                            <li>
                            <?php echo anchor('staff', 'Staff'); ?>
                                <ul>
                                    <li><?php echo anchor('families', 'Family'); ?></li>
                                    <li><?php echo anchor('education', 'Education'); ?></li>
                                    <li><?php echo anchor('work_histories', 'Work History'); ?></li>
                                    <li><?php echo anchor('medical_histories', 'Medical History'); ?></li>
                                    <li><?php echo anchor('salary_component', 'Salary Component'); ?></li>
                                    <li><?php echo anchor('salary', 'Salary'); ?></li>
                                </ul>
                            </li>
                            <li><?php echo anchor('assets', 'Assets'); ?></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </body>
</html>