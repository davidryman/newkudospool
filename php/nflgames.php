<?php
$week = "./data/nfl_week_no.txt";
$weekno = file($week);
$gamesfile = "./data/nfl_week_".rtrim($weekno[0]).".txt";
$games = file($gamesfile);
echo '<br />';
createtable();
  echo '<tr><td>';
  createtable();
    echo '<tr><td>';
// first field name is for the alias
    echo "Alias:";
// actual description field
    echo '<input';
// add onfocus to get alias
    echo ' onfocus="if(this.value=='."''".'){popCookie('."'".'name'."'".',this.id)}"';
// add id, name and value
    echo ' id="wname" name="wname" value="" />';
    echo '</td></tr>';
    echo '<tr class="gamerow"><td colspan="3">';
    echo 'NFL Week '.rtrim($weekno[0]).' - '.count($games).' games this week.';
    echo '</td></tr>';
    echo '<tr class="gamerow"><td colspan="3">';
    echo 'Prediction deadline is '.rtrim($weekno[2]).' on '.rtrim($weekno[1]);
    echo '</td></tr>';
    echo '<tr class="gameerr"><td>';
    echo '<div id="linkerror"></div>';
    echo '</td>';
    echo '</td></tr>';
    echo '<tr class="gamerow"><td>';
// second field name is for the site URL
    echo "Email:";
// email address
    echo '<input';
// add id, name and value
    echo ' id="wemail" name="wemail" value="" /><br />';
// add check/add button
    echo '<button';
    echo ' id="butt"';
    echo ' onclick="addguess('."'".'wname'."','".'wemail'."','game'".",".'this.id)">';
    echo 'Submit Selection';
    echo '</button>';
    echo '</td></tr></table>';
  echo '<td>';
  createtable();
    for($i=0;$i<count($games);$i++)
      {
      echo '<tr class="gamerow">';
      $gamebits = explode("_",rtrim($games[$i]));
      echo '<td class="gamesnum">'.'Game '.($i+1).'</td>';
      echo '<td class="games">'.' <input type="radio" name="game'.$i.'" id="game'.$i.'v" value="'.$gamebits[0].'">'.$gamebits[0].'</input></td>';
      echo '<td class="games">'.'<input type="radio" name="game'.$i.'" id="game'.$i.'h" value="'.$gamebits[2].'">'.$gamebits[2].'</input></td>';
      echo '</tr>';
      }
    echo '</tr></table>';
  echo '</td><td>Other games here';
  echo '</td></tr></table>';
  
function createtable()
    {
// create table tag
    echo '<table border="0" valign="top" cellspacing="0" cellpadding="0">';
    }
?>
