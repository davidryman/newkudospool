<?php
$what = "./data/".$menu.".txt";
$file = fopen($what,"r") or exit("menu file for ".$menu." missing");
echo '<table class="float" id="float" border="2"><tr>'."\n";
while(!feof($file))
    {
    $data = fgets($file);
    $data_a = explode("|",$data);
    echo '<td class="L_menu" onclick="'.$data_a[1].'">'.$data_a[0].'</td>'."\n";
    }
echo '</tr><tr><td height="*"></td></tr>';
echo '</table>';
fclose($file);
?>

