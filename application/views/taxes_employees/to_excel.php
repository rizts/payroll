<?php

$title = "Tax Status";
$content_header = '<table width="1024" cellpadding="2" cellspacing="0" style="font-size: 11px; font-family: tahoma;">
            <tr style="font-weight: bold;">
                <td width="10">&nbsp;SP ID</td>
                <td width="90">&nbsp;SP Status</td>
                <td width="90">&nbsp;SP PTKP</td>
            </tr>';
$content_footer = "</table>";
$content_dalam = "";
$query = $this->db->query("SELECT * FROM taxes_employees ORDER BY sp_id ASC");


$x = 0;

foreach ($query->result() as $row) {
    $data = "<tr><td>" . $row->sp_id . "</td>
                <td>" . $row->sp_status . "</td>
                <td>" . rupiah($row->sp_ptkp) . "</td>
                    </tr>";
    $content_dalam = $content_dalam . "\n" . $data;
}

$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Taxes_Employees.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>