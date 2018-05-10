<?php
$weekno = $_REQUEST["week"];
$alias = $_REQUEST["alias"];
if ($alias == "")
  {
  echo "No alias selected";
  return;
  }
// pick file in format: alias|email|picks - picks are 0 for road 1 for home e.g. 1010000101001101
$picksfile = "../../v2/data/nfl_week_".rtrim($weekno)."_picks.txt";
// $picks array for all aliases
$picks = file($picksfile);
// games file in format: roadteam_at_hometeam
$gamesfile = "../../v2/data/nfl_week_".rtrim($weekno).".txt";
$games = file($gamesfile);
// scores file in format: roadteam,pts,hometeam,pts
$scoresfile = "../../v2/data/nfl_week_".rtrim($weekno)."_scores.txt";
$scores = file($scoresfile);
// lines file in format: mm/yy hh:mm ts\tfav.\t-pts\tunderdog\ttotalpts
$linesfile = "../../v2/data/nfl_week_".rtrim($weekno)."_lines.txt";
$lines = file($linesfile);
foreach ($lines as $line)
  {
//$ldata - [mm/yy hh:mm ts][fav.][-pts][underdog][totalpts]
  $ldata = explode("\t",$line);
// Text lines can be present eg "Monday night games"
  if (count($ldata) > 1)
    {
// $fav - array of favorites
    $fav = str_replace("At ","",$ldata[1]);
// $udog - array of underdogs
    $udog = str_replace("At ","",$ldata[3]);
// $lpts - the line -nn 
    $lpts = $ldata[2];
// $tpts - total points expected
//    $tpts[] = $ldata[4];
// $linefpts - make N.Y. = NY and make associative array containing -ve line for favs
    $linefpts[str_replace(".","",trim($fav))] = $lpts;
// $lineupts - make N.Y. = NY and make associative array containing +ve line for underdogs
    $lineupts[str_replace(".","",trim($udog))] = -$lpts;
    }
  }
foreach ($scores as $score)
  {
// $sdata - [roadteam][pts][hometeam][pts]
  $sdata = explode(",",$score);
// ignore blank lines or anything not right
  if (count($sdata)>1)
    {
// make associative array of all teams and their pts
    $points[$sdata[0]] = $sdata[1];
    $points[$sdata[2]] = $sdata[3];
    }
  }
echo "Head to Head<br />";
createtable();
$roadteam = "<tr><td>Road</td>";
$hometeam = "<tr><td>Home</td>";
$at = "<tr><td>AT</td>";
$line = "<tr><td>Line</td>";
$linetotal = "<tr><td>Total Line</td>";
foreach($games as $game)
  {
  $data = explode("_",$game);
// fav is road team show name and -ve line
  if ($linefpts[str_replace(".",'',trim($data[0]))]!="")
      {
      $whor = "green";
      $whoh = "red";
      $pts = -$linefpts[str_replace(".","",trim($data[0]))];
//      $rline = substr($gdata[0],0,3)." by ".$pts;
      }
// fav is home team show name and +ve line
    else
      {
      $whor = "red";
      $whoh = "green";
      $pts = -$linefpts[str_replace(".","",trim($data[2]))];
//      $pts = -$lineupts[str_replace(".","",trim($data[2]))];
//      $rline = substr($gdata[2],0,3)." by ".-$linefpts[str_replace(".",'',trim($gdata[2]))];
      }
 
  $roadteam = $roadteam.'<td style="color: white; background-color: '.$whor.'">'.substr($data[0],0,3).'</td>';
  $at = $at.'<td>'.$data[1].'</td>';
  $hometeam = $hometeam.'<td style="color: white; background-color: '.$whoh.'">'.substr($data[2],0,3).'</td>';
  $line = $line.'<td style="color: white; background-color: green">'.$pts.'</td>';
  }
echo $roadteam."\n".$at."\n".$hometeam."\n".$line."\n";
    echo '<td style="color: white; background-color: '.$who.'">'.$rline."</td>";
foreach($picks as $data)
  {
  $pick = explode("|",$data);
  $adata = "<tr><td>".$pick[0];
  
  $adata = $adata."</td></tr>";
  echo $adata;
  }
foreach($picks as $line)
  {
// $data - [alias][email][picks]
  $data = explode("|",rtrim($line));
// find alias in array
  if ($data[0] == $alias)
    {
    break;
    }
  }
// if alias not found you can't see the scores
if ($data[0] == $alias)
  {
  createtable();
  echo "<tr><td colspan=".'"5"><b>'."Points for ".$alias." for week ".$weekno."</b></td></tr>";
  echo "<tr><td><b>Game</b></td><td><b>".$alias."</b><td><b>Line</b></td><td><b>Score</b></td><td><b>Points</b></td></tr>";
  $pelem =0;
  foreach ($games as $game)
    {
    echo "<tr><td>";
// $gdata - [roadteam][at][hometeam]
    $gdata = explode("_",rtrim($game));
// display matchup in first column
    echo $gdata[0]." ".$gdata[1]." ".$gdata[2]."</td>";
// Alias's pick
    $pick = "";
    $notpick = "";
// $pick is team picked, $notpick is team not picked
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
// if fav picked show green else show red
    if ($linefpts[str_replace(".",'',$pick)] < 0)
      {$color = "green";}
    else {$color = "red";}
// display picked team in next column
    echo '<td style="color: white; background-color:'.$color.'">'.$pick."</td>";
// Betting lines
// fav is road team show name and -ve line
    if ($linefpts[str_replace(".",'',trim($gdata[0]))]!="")
      {
      $who = "orange";
      $pts = -$linefpts[str_replace(".","",trim($gdata[0]))];
      $rline = substr($gdata[0],0,3)." by ".$pts;
      }
// fav is home team show name and +ve line
    else
      {
      $who = "blue";
      $rline = substr($gdata[2],0,3)." by ".-$linefpts[str_replace(".",'',trim($gdata[2]))];
      }
    echo '<td style="color: white; background-color: '.$who.'">'.$rline."</td>";
// Score
    echo '<td style="text-align: center;">'.$points[$gdata[0]]."-".$points[$gdata[2]]."</td>";
// Points
// new scoring method is:
// if you pick the loser then you lose the points.
// if you pick the underdog and they win you get the points plus the line
// if you pick the fav and they win by more than the line you get points - line.
// score is pts for picked team - points for not picked team
    $gotpoints = 0;
    $route = "";
    $winpoints = $points[$pick]-$points[$notpick];
// check to see if winner picked i.e. +ve pts.
    if ($winpoints>0)
      {$pickedwinner = true;}
    else {$pickedwinner = false;}
    if ($linefpts[str_replace(".","",$pick)] == "")
      {$pickedunderdog = true;}
    else {$pickedunderdog = false;}
// picked a winner
    if ($pickedwinner)
      {
      $route = $route."w:";
// picked the underdog
      if ($pickedunderdog)
        {
        $route = $route."u:";
        $gotpoints = $winpoints + $lineupts[str_replace(".","",$pick)];
        }
// picked the fav
      else
        {
        if ($winpoints > $lineupts[str_replace(".","",$notpick)])
          {
          $route = $route."f:";
          $gotpoints = $winpoints + $linefpts[str_replace(".","",$pick)];
          }
        }
      }
// sorry you picked the wrong one
    else
      {
      $gotpoints = $winpoints;
      }
// accumulate total pts
    $totalpts = $totalpts + $gotpoints;
// color the points
    if ($gotpoints < 0)
      {$color = 'red';}
    else
      {$color = 'green';}
// display points
    echo '<td style="color: white; text-align: center; background-color: '.$color.';"'.'>'.$gotpoints.'</td></tr>';
    }
// above section repeated until all games have been scored
// Totals
//
  echo "<tr><td><b>Totals</b></td><td></td><td></td><td></td><td align=".'"center"'.">".$totalpts."</td></tr>";
  echo "</table>";
// update score in score director
// file alias cannot include blanks so change to underscore
  $falias = str_replace(" ","_",$alias);
  $fsafile = "../../v2/data/scores/week_".rtrim($weekno)."_".$falias."_score.txt";
  $fscoresfile = fopen($fsafile,"w") or exit ("Problem with ".$fsafile);
// write total points to alias' file
  fwrite($fscoresfile,$totalpts);
  fclose($fscoresfile);
  }
else
  {
// alias not found in picks file
  echo "Alias ".$alias." has no prediction to score.";
  return;
  }
function createtable()
    {
// create table tag
    echo '<table border="1" valign="top" cellspacing="0" cellpadding="0" width="100%">';
    }
?>
