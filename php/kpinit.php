<?php
$selyr = $_REQUEST["syear"];
$selwk = $_REQUEST["sweek"];
if ($selyr == ""){$base = "./data/";}
else {$base = "../data/";}
$week = $base."nfl_yweek_no.txt";
$weekno = file($week);
if ($selyr == "") {$selyr = rtrim($weekno[0]);}
if ($selwk == "") {$selwk = rtrim($weekno[1]);}
$gamesfile = $base.$selyr."/nfl_week_".$selwk.".txt";
$games = file($gamesfile);
$now_date = getdate();
$oldgame = true;
$cut = explode("/",$weekno[2]);
$cur_date = mktime($now_date[hours],$now_date[minutes],$now_date[seconds],$now_date[month],$now_date[mday],$now_date[year]);
$cut_date = mktime(8,0,0,$cut[0],$cut[1],$cut[2]);
if ($selyr.$selwk < $weekno[0].$weekno[1])
//if ($cur_date > $cut_date)
  {$oldgame = true;}
else
  {$oldgame = false;}
echo '<div id="kpholder">';
echo '<div id="kpselection">';
echo '<div id="kpyears">';
echo 'Years <select id="syear">';
for ($i=2006;$i<2018;$i++)
  {
  echo '<option value="'.$i.'"';
  if ($i == $selyr)
    {
    echo ' selected="selected"';
    }
  echo '>'.$i.'</option>';
  }
echo '</select>';
echo '</div>';
echo '<div id="kpweeks">';
echo 'Weeks  <select id="sweek">';
for ($i=1;$i<18;$i++)
  {
  echo '<option value="'.$i.'"';
  if ($i == $selwk)
    {
    echo ' selected="selected"';
    }
  echo '>'.$i.'</option>';
  }
echo '</select>';
echo '<button onclick="dispsch()">Go</button>';
// Display current date
if (!$oldgame)
  {
  echo '<span id="update"><button onclick="updpicks()">Update Picks</button></span>';
  }
echo $cur_date.'-'.$cut_date;
if ($oldgame)
  {echo 'Past cut-off date - '.$cut[0].'-'.$cut[1].'-'.$cut[2];}
else
  {echo 'Pickable games';}
echo '<span id="who"></span>';
echo '<span id="ndate">'.$now_date[weekday].", ".$now_date[mday]." ".$now_date[month]." ".$now_date[year]."</span>";
echo '<div id="linkerror">Message</div>';
echo '</div>';
echo '</div>';
echo '<div id="csel">';
echo 'Next Games: '.$weekno[0].' - '.$weekno[1];
echo 'Cut-off: '.$weekno[2].' - '.$weekno[3];
echo "Selected Games: ".$selwk.' - '.$selyr;
echo '</div>';
echo '<div id="kpdata">';
echo '<div id="kppicks">';
echo 'Your Picks. <br />';
  createtable();
    for($i=0;$i<count($games);$i++)
      {
      echo '<tr class="gamerow">';
      $gamebits = explode("_",rtrim($games[$i]));
      echo '<td class="gamesnum">'.'Game '.($i+1).'</td>';
      echo '<td class="games">'.' <input type="radio" name="game'.$i.'" id="game'.$i.'v" value="'.$gamebits[0].'">'.$gamebits[0].'</td>';
      echo '<td class="games">'.'<input type="radio" name="game'.$i.'" id="game'.$i.'h" value="'.$gamebits[2].'">'.$gamebits[2].'</td>';
      echo '</tr>';
      }
    echo '</tr></table>';
echo '</div>';
// Look for picks and update page if available and not passed games.
echo '<div id="kplines">';
/* BETTING LINES
*/
echo 'Betting lines';
$linesfile = $base.$selyr."/nfl_week_".rtrim($selwk)."_lines.txt";
if (file_exists($linesfile))
  {
  $lines = file($linesfile);
  createtable();
  echo '<tr class="linesrow"><td colspan="5"><b>NFL Lines week '.$selwk.'/'/$selyr.'</b></td></tr>';
//echo count($games)." week no ".$weekno." lines file ".$gamesfile."<br />".getcwd();
  for ($i=0;$i<count($lines);$i++)
      {
      $data = explode("\t",$lines[$i]);
      echo '<tr>';
      for ($j=0;$j<count($data);$j++)
        {
        if (count($data)==1)
          {
          echo '<td colspan="5">';
          }
        else
          {
          echo '<td class="lines">';
          }
        echo $data[$j]."</td>";
        }
      echo "</tr>";
//    echo count($data)." - ".rtrim($games[$i])."<br />";
      }
  echo "</table>";
  }
else {echo 'No Betting lines found';}
// END OF BETTING LINES
echo '</div>';
echo '<div id="kpresults">';
echo 'Results';
/* RESULTS
*/
$scoresfile = $base.$selyr."/nfl_week_".$selwk."_scores.txt";
if (file_exists($scoresfile))
  {
  $scores = file($scoresfile);
//echo 'line count '.count($games);
  if (count($scores)==0)
    {
    echo "No Scores available";
    return;
    }
  createtable();
  echo '<tr class="scoresrow"><td colspan="5"><b>Nfl.com NFL Results for week '.$selwk.'</b></td></tr>';
//echo count($games)." week no ".$weekno." lines file ".$gamesfile."<br />".getcwd();
  for ($i=0;$i<count($scores);$i++)
      {
      $data = explode(",",$scores[$i]);
      echo '<tr>';
      for ($j=0;$j<count($data);$j++)
        {
        if (count($data)==1)
          {
          echo '<td colspan="5" class="scores">';
          }
        else
          {
          echo '<td class="scores">';
          }
        echo $data[$j]."</td>";
        }
      echo "</tr>";
//    echo count($data)." - ".rtrim($games[$i])."<br />";
      }
  echo "</table>";
  }
else
  {
  echo "No Scores available yet";
  return;
  }
// END OF RESULTS
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
function createtable()
    {
// create table tag
    echo '<table border="0" valign="top" cellspacing="1" cellpadding="1">';
    }
?>
