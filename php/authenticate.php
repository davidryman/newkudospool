<?php
$walias = $_REQUEST["alias"];
$wpword = $_REQUEST["pword"];
//$cwd = getcwd();
//echo $cwd;
$mfile = '../members/'.$walias.'.xml';
$file = fopen($mfile,"r") or exit("Alias ".$walias."not registered");
while (!feof($file))
    {
    $data = fgets($file);
    if (substr($data,0,7)=="<pword>")
        {
        $word = rtrim(strip_tags($data));
        if ($word == $wpword)
            {
            echo 'OK '.$walias;
//            setrawcookie('alias',$alias,'','','kudospool.DavidRyman.com');
            }
        else
            {
            echo 'Password.'.$wpword.' incorrect';
            }
        }
    else
        {
        continue;
        }
    }
fclose($file);
return $data;
?>
