<?php
$cfile = $f.'.txt';
if(file_exists($cfile))
  {
  $data = file($cfile);
  $count = rtrim($data[0]);
  }
else
  {
  $count = 0;
  }
$count++;
echo $count;
$file = fopen($cfile,"w+") or exit("0");
fwrite($file,$count);
fclose($file); 
?>
