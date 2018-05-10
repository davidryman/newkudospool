<?php
$weekno = $_REQUEST["week"];
$alias = $_REQUEST["alias"];
if ($alias == "")
  {
  echo "No alias selected";
  return;
  }
$picksfile = "../../v2/data/nfl_week_".rtrim($weekno)."_picks.txt";
$picks = file($picksfile);
createtable();
foreach($picks as $line)
  {
//  echo $line."<br />";
  $data = explode("|",rtrim($line));
  echo "<tr><td>".$data[0]."</td></tr>";
  }
echo "</table>";
function createtable()
    {
// create table tag
    echo '<table border="0" valign="top" cellspacing="0" cellpadding="0" width="100%">';
    }
?>
