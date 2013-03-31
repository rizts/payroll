<?php

$title = "Staffs";
$content_header = '<table width="1024" cellpadding="2" cellspacing="0" style="font-size: 11px; font-family: tahoma;">
            <tr style="font-weight: bold;">
                <td width="10">&nbsp;Staff ID</td>
                <td width="90">&nbsp;NIK</td>
                <td width="90">&nbsp;Kode Absen</td>
                <td width="90">&nbsp;Name</td>
                <td width="90">&nbsp;Address</td>
                <td width="90">&nbsp;Email</td>
                <td width="90">&nbsp;Email Alternatif</td>
                <td width="90">&nbsp;Phone Home</td>
                <td width="90">&nbsp;Phone HP</td>
                <td width="90">&nbsp;Taxes Status</td>
                <td width="90">&nbsp;Marital Status</td>
                <td width="90">&nbsp;Employe Status</td>
                <td width="90">&nbsp;Branch</td>
                <td width="90">&nbsp;Department</td>
                <td width="90">&nbsp;Title</td>
                <td width="90">&nbsp;Birthdate</td>
                <td width="90">&nbsp;Birthplace</td>
                <td width="90">&nbsp;Gender</td>
            </tr>';
$content_footer = "</table>";
$content_dalam = "";
$query = $this->db->query("SELECT * FROM staffs ORDER BY staff_name ASC");


$x = 0;


foreach ($query->result() as $row) {
    $data = "<tr><td>" . $row->staff_id . "</td>
                <td>" . $row->staff_nik . "</td>
                <td>" . $row->staff_kode_absen . "</td>
                <td>" . $row->staff_name . "</td>
                <td>" . $row->staff_address . "</td>
                <td>" . $row->staff_email . "</td>
                <td>" . $row->staff_email_alternatif . "</td>
                <td>" . $row->staff_phone_home . "</td>
                <td>" . $row->staff_phone_hp . "</td>
                <td>" . $row->staff_status_pajak . "</td>
                <td>" . $row->staff_status_nikah . "</td>
                <td>" . $row->staff_status_karyawan . "</td>
                <td>" . $row->staff_cabang . "</td>
                <td>" . $row->staff_departement . "</td>
                <td>" . $row->staff_jabatan . "</td>
                <td>" . $row->staff_birthdate . "</td>
                <td>" . $row->staff_birthplace . "</td>
                <td>" . $row->staff_sex . "</td>
             </tr>";
    $content_dalam = $content_dalam . "\n" . $data;
}

$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Staffs.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>