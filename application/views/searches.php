<?php get_header(); ?>
<div class="body">
    <div class="content">
        <div class="page-header">
            <div class="icon">
                <span class="ico-search"></span>
            </div>

            <h1>Search Advance
                <small> <?php echo $results; ?></small>
            </h1>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Cabang</th>
                    <th>Departement</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <?php
            foreach ($search_list as $row) {
            ?>
                <tr>
                    <td><?php echo $row->staff_nik; ?></td>
                    <td><?php echo $row->staff_nama; ?></td>
                    <td><?php echo $row->staff_cabang; ?></td>
                    <td><?php echo $row->staff_departement; ?></td>
                    <td><?php echo $row->staff_jabatan; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>


<?php get_footer(); ?>
