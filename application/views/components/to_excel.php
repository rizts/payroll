<?php

$title = "Components";
$content_header = '<table width="1024" cellpadding="2" cellspacing="0" style="font-size: 11px; font-family: tahoma;">
            <tr style="font-weight: bold;">
                <td width="10">&nbsp;Comp ID</td>
                <td width="90">&nbsp;Comp Name</td>
                <td width="90">&nbsp;Comp Type</td>
            </tr>';
$content_footer = "</table>";
$content_dalam = "";
$query = $this->db->query("SELECT * FROM components ORDER BY comp_id ASC");


$x = 0;

foreach ($query->result() as $row) {
    $data = "<tr><td>" . $row->comp_id . "</td>
                <td>" . $row->comp_name . "</td>
                <td>" . $row->comp_type . "</td>
                    </tr>";
    $content_dalam = $content_dalam . "\n" . $data;
}

$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Components.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>