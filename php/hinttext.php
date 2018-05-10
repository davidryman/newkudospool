<?php
$data = array();
$hint = "../../v2/data/".$_REQUEST["file"];
$file = fopen($hint,"r") or exit("");
//echo "A grid of ".$gelements." elements creates a matrix of ".$gw." by ".$gh."<br />";
createtable();
echo '<tr><td>';
while (!feof($file))
    {
    $text = fgets($file);
    echo $text;
    }
echo '</td></tr></table>';
function createtable()
    {
// create table tag
    echo '<table class="hint" border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">';
    }
?>

