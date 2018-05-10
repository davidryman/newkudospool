<?php
$dir = "../../v2/data/scores";
$sfiles = scandir($dir);
$weekno = $_REQUEST['week'];
$fpart = "week_".rtrim($weekno)."_";
foreach($sfiles as $sfile)
  {
  if (substr($sfile,0,strlen($fpart)) == $fpart)
    {
    $fsdata = explode("_",$sfile);
    $sdata = file($dir."/".$sfile);
    $scores[$fsdata[2]] = trim($sdata[0]);
    } 
  }
echo $scores;
?>
