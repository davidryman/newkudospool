<?php
$walias = $_REQUEST["alias"];
$wpword = $_REQUEST["pword"];
$wname = $_REQUEST["aname"];
$wemail = $_REQUEST["aemail"];
$wloc = $_REQUEST["aloc"];
$wsex = $_REQUEST["asex"];
$wcom = $_REQUEST["acom"];
if ($walias=="")
    {
    echo 'Alias is blank.<br />';
    return;
    }
$mfile = '../../v2/members/'.$walias.'.xml';
$file = fopen($mfile,"x") or exit($walias." has already registered, sign in or choose a different alias. ");
$data = "<?xml version='1.0'?>\n";
$data = $data."<member>\n";
$data = $data."<alias>".$walias."</alias>\n";
$data = $data."<pword>".$wpword."</pword>\n";
$data = $data."<name>".$wname."</name>\n";
$data = $data."<email>".$wemail."</email>\n";
$data = $data."<location>".$wloc."</loc>\n";
$data = $data."<sex>".$wsex."</sex>\n";
$data = $data."<comment>".$wcom."</comment>\n";
$data = $data."</member>\n";
$data = $data."?>";

echo 'Member '.$walias.' has been registered';
fwrite($file,$data);
fclose($file);
?>

