<?php
$weekno = $_REQUEST["week"];
$gamesfile = "../../v2/data/nfl_week_".rtrim($weekno)."_scores.txt";
$games = file($gamesfile);
//echo 'line count '.count($games);
if (count($games)==0)
  {
  echo "No Lines available";
  return;
  }
createtable();
echo '<tr><td colspan="5"><b>Nfl.com NFL Results for week '.$weekno.'</b></td></tr>';
//echo count($games)." week no ".$weekno." lines file ".$gamesfile."<br />".getcwd();
for ($i=0;$i<count($games);$i++)
    {
    $data = explode(",",$games[$i]);
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
