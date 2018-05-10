<?php
$initial = "current_news";
$what = "./data/".$initial.".txt";
$file = fopen($what,"r") or exit("The header ".$what." file missing");
echo '<table class="text" id="text" border="0"><tr><td class="text">'."\n";
$lines = 0;
while(!feof($file))
    {
    $data = rtrim(fgets($file));
    if ($lines++ == 0)
        {
        echo $data.'<ul>';
        }
    else
        {
        if ($data != "")
            {
            echo "<li>".$data."</li>";
            }
        }
    }
echo '</ul>';
echo '</td></tr>';
echo '</table>';
fclose($file);
?>

