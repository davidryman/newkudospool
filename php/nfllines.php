<?php
$weekno = $_REQUEST["week"];
$gamesfile = "../../v2/data/nfl_week_".rtrim($weekno)."_lines.txt";
$games = file($gamesfile);
createtable();
echo '<tr><td colspan="5"><b>FootballLocks.com NFL Lines week '.$weekno.'</b></td></tr>';
//echo count($games)." week no ".$weekno." lines file ".$gamesfile."<br />".getcwd();
for ($i=0;$i<count($games);$i++)
    {
    $data = explode("\t",$games[$i]);
    echo '<tr>';
    for ($j=0;$j<count($data);$j++)
      {
      if (count($data)==1)
        {
        echo '<td colspan="5">';
        }
      else
        {
        echo '<td>';
        }
      echo $data[$j]."</td>";
      }
    echo "</tr>";
//    echo count($data)." - ".rtrim($games[$i])."<br />";
    }
echo "</table>";
function createtable()
    {
// create table tag
    echo '<table border="0" valign="top" cellspacing="0" cellpadding="0" width="100%">';
    }
?>
