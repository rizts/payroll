<?php

$title = "Titles";
$content_header = '<table width="1024" cellpadding="2" cellspacing="0" style="font-size: 11px; font-family: tahoma;">
            <tr style="font-weight: bold;">
                <td width="10">&nbsp;Title ID</td>
                <td width="90">&nbsp;Title Name</td>
            </tr>';
$content_footer = "</table>";
$content_dalam = "";
$query = $this->db->query("SELECT * FROM titles ORDER BY title_id ASC");


$x = 0;

foreach ($query->result() as $row) {
    $data = "<tr><td>" . $row->title_id . "</td>
                <td>" . $row->title_name . "</td>
                    </tr>";
    $content_dalam = $content_dalam . "\n" . $data;
}

$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Titles.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>