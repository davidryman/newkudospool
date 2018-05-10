<?php
$what = "./data/".$header.".txt";
$file = fopen($what,"r") or exit("The header ".$what." file missing");
echo '<table class="header" id="header" border="0"><tr>'."\n";
while(!feof($file))
    {
    $data = rtrim(fgets($file));
    if ($data != "")
        {
        echo '<td>'.$data.'</td>';
        }
    }
echo '</td></tr>';
echo '</table>';
fclose($file);
?>

