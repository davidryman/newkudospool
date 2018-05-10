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
foreach($picks as $line)
  {
//  echo $line."<br />";
  $data = explode("|",rtrim($line));
  if ($data[0] == $alias)
    {
    break;
    }
  }
if ($data[0] == $alias)
  {
  createtable();
  echo "<tr><td colspan=".'"5"><b>'."Points for ".$alias." for week ".$weekno."</b></td></tr>";
  echo "<tr><td><b>Game</b></td><td><b>".$alias."</b><td><b>Line</b></td><td><b>Score</b></td><td><b>Points</b></td></tr>";
  $gamesfile = "../../v2/data/nfl_week_".rtrim($weekno).".txt";
  $games = file($gamesfile);
  $scoresfile = "../../v2/data/nfl_week_".rtrim($weekno)."_scores.txt";
  $scores = file($scoresfile);
  $linesfile = "../../v2/data/nfl_week_".rtrim($weekno)."_lines.txt";
  $lines = file($linesfile);
  foreach ($lines as $line)
    {
    $ldata = explode("\t",$line);
    if (count($ldata) > 1)
      {
      $fav = str_replace("At ","",$ldata[1]);
      $udog = str_replace("At ","",$ldata[3]);
      $lpts = $ldata[2];
      $linefpts[str_replace(".","",trim($fav))] = $lpts;
      $lineupts[str_replace(".","",trim($udog))] = -$lpts;
      }
    }
  foreach ($scores as $score)
    {
    $sdata = explode(",",$score);
    if (count($sdata)>1)
      {
      $points[$sdata[0]] = $sdata[1];
      $points[$sdata[2]] = $sdata[3];
      }
    }
  $pelem =0;
  foreach ($games as $game)
    {
    echo "<tr><td>";
    $gdata = explode("_",rtrim($game));
    echo $gdata[0]." ".$gdata[1]." ".$gdata[2]."</td>";
// Alias's pick
    $pick = "";
    $notpick = "";
    if (substr($data[2],$pelem++,1)=="0")
      {
      $pick = trim($gdata[0]);
      $notpick = trim($gdata[2]);
      }
    else
      {
      $notpick = trim($gdata[0]);
      $pick = trim($gdata[2]);
      }
    echo "<td>".$pick."</td>";
// Betting lines
    if ($linefpts[str_replace(".",'',trim($gdata[0]))]!="")
      {
      $pts = -$linefpts[str_replace(".","",trim($gdata[0]))];
      $rline = substr($gdata[0],0,3)." by ".$pts;
      }
    else
      {
      $rline = substr($gdata[2],0,3)." by ".-$linefpts[str_replace(".",'',trim($gdata[2]))];
      }
    echo "<td>".$rline."</td>";
// Score
    echo "<td>".$points[$gdata[0]]."-".$points[$gdata[2]]."</td>";
// Points
    $gotpoints = $points[$pick]-$points[$notpick];
    if ($gotpoints>0)
      {
      $gotpoints = $gotpoints + $lineupts[str_replace(".","",$pick)];
      }
    $totalpts = $totalpts + $gotpoints;
    echo "<td align=".'"center"'.">".$gotpoints."</td></tr>";
    }
// Totals
  echo "<tr><td><b>Totals</b></td><td></td><td></td><td></td><td align=".'"center"'.">".$totalpts."</td></tr>";
  echo "</table>";
// update score in score director
  $falias = str_replace(" ","_",$alias);
  $fsafile = "../../v2/data/scores/week_".rtrim($weekno)."_".$falias."_score.txt";
  $fscoresfile = fopen($fsafile,"w") or exit ("Problem with ".$fsafile);
  fwrite($fscoresfile,$totalpts);
  fclose($fscoresfile);
  }
else
  {
  echo "Alias ".$alias." has no prediction to score.";
  return;
  }
function createtable()
    {
// create table tag
    echo '<table border="1" valign="top" cellspacing="0" cellpadding="0" width="100%">';
    }
?>
