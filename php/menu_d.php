<?php
$what = "./data/".$menu.".txt";
$file = fopen($what,"r") or exit("The menu ".$what." file missing");
echo '<table class="float" id="float" border="0"><tr>'."\n";
while(!feof($file))
    {
    $data = fgets($file);
    $data_a = explode("|",$data);
// add td tag
    echo '<td class="L_menu"';
// add onclick event
    echo ' onclick="'.$data_a[1].'"';
// add onmouseover event
    echo ' onmouseover="preview('."'".$data_a[0].'.txt'."')".'"';
// close opening td tag
    echo '>';
// add display text
    echo $data_a[0];
// close td and tr tags
    echo '</td></tr>'."\n";
    }
echo '<tr><td height="*"></td></tr>';
echo '</table>';
fclose($file);
?>

