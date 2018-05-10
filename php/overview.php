<?php
$initial = "overview";
$what = "../data/".$initial.".html";
$file = fopen($what,"r") or exit("The ".$what." file missing");
while(!feof($file))
    {
    $data = fgets($file);
    echo $data;
    }
fclose($file);
?>

