<?php

$title = "Users";
$content_header = '<table width="1024" cellpadding="2" cellspacing="0" style="font-size: 11px; font-family: tahoma;">
            <tr style="font-weight: bold;">
                <td width="10">&nbsp;User ID</td>
                <td width="90">&nbsp;Staff ID</td>
                <td width="90">&nbsp;Username</td>
                <td width="90">&nbsp;Role ID</td>
                <td width="90">&nbsp;Created at</td>
                <td width="90">&nbsp;Update at</td>
            </tr>';
$content_footer = "</table>";
$content_dalam = "";
$query = $this->db->query("SELECT * FROM users ORDER BY username ASC");


$x = 0;

foreach ($query->result() as $row) {
    $data = "<tr><td>" . $row->id . "</td>
                <td>" . $row->staff_id . "</td>
                <td>" . $row->username . "</td>
                <td>" . $row->role_id . "</td>
                <td>" . $row->created_at . "</td>
                <td>" . $row->updated_at . "</td>
                    </tr>";
    $content_dalam = $content_dalam . "\n" . $data;
}

$content_sheet = $title . "\n" . $content_header . "\n" . $content_dalam . "\n" . $content_footer;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Users.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $content_sheet;
?>