<?php
$initial = "initial_text";
$what = "./data/".$initial.".txt";
$file = fopen($what,"r") or exit("The header ".$what." file missing");
echo '<table class="text" id="text" border="0"><tr><td class="text">'."\n";
while(!feof($file))
    {
    $data = fgets($file);
    echo "<p>".$data."</p>";
    }
echo '<td class=cell"></td></td></tr>';
echo '</table>';
fclose($file);
?>

