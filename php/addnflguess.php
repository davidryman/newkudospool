<?php
$initial = "nfl_week_no";
$initialb = "nfl_yweek_no";
$what = "../data/".$initialb.".txt";
$week = file($what);
$weekfile = "../data/".rtrim($week[0]."/nfl_week_".rtrim($week[1])."_picks.txt");
$file = fopen($weekfile,"a") or exit("The NFL file ".$weekfile." file missing");
$walias = $_REQUEST["alias"];
$wemail = $_REQUEST["email"];
$wguess = $_REQUEST["picks"];
$error = fwrite($file,$walias."|".$wemail."|".$wguess."\n");
fclose($file);
if ($error)
    {
    echo $wguess." has been added to the picks for ".$walias." to ".$weekfile;
    }
else
    {
    echo $wguess." has NOT been added to the picks for ".$walias." to ".$weekfile;
    }
?>

