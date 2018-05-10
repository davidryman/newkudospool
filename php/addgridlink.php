<?php
$initial = "grid1";
$what = "../../v2/data/".$initial.".txt";
$file = fopen($what,"a") or exit("The header ".$what." file missing");
$wname = $_REQUEST["what"];
$wlink = $_REQUEST["link"];
$wclass = $_REQUEST["class"];
$error = fwrite($file,$wname."|".$wlink."|".$wclass."\n");
fclose($file);
if ($error)
    {
    echo $wname." has been added to the grid linked to ".$wlink;
    }
else
    {
    echo $wname." has NOT been added to the grid linked to ".$wlink;
    }
?>

