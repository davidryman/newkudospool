<?php
$asscol;
$data = array();
$grid = $_REQUEST["file"];
$what = $grid.".txt";
$colors = $grid."colors.txt";
$data = file($what);
$fcolor= file($colors);
sort($data);
echo '<table width="100%"><tr>';
for ($c=0; $c<count($fcolor); $c++)
    {
    $colorelements = explode("|",$fcolor[$c]);
    $asscol[$colorelements[0]] = rtrim($colorelements[1]);
    echo '<td align="center" style="color:gray; background:'.$colorelements[1].'">'.rtrim($colorelements[0]).'</td>';
    }
echo '</tr></table>';
$gw=0;
$gh=0;
$gelements = count($data);
//print_r($data);echo "<br />";
$gw = definegrid($gelements);
$gh = $gelements/$gw;
// form to add content
// first field name is for the site description
echo "Web Site name:";
// actual description field
echo '<input';
// add onfocus event
echo ' onfocus="changevalue('."'".'butt'."','".'Check Link'."'".')"';
// add id, name and value
echo ' id="wname" name="wname" value="" />';
// secon field name is for the site URL
echo "URL: http://";
// actual description field
echo '<input';
// add onfocus event
echo ' onfocus="changevalue('."'".'butt'."','".'Check Link'."'".')"';
// add id, name and value
echo ' id="wlink" name="wlink" value="" />';
// add classification selection
echo ' <select id="cclass">';
echo ' <option value"" selected="selected">Unclassified</option>';
for ($c=0; $c<count($fcolor); $c++)
    {
    $colorelements = explode("|",$fcolor[$c]);
    echo '<option value="'.$colorelements[0].'">'.$colorelements[0].'</option>';
    }
echo '</select>';
// add check/add button
echo '<button';
echo ' id="butt"';
echo ' onclick="addlink('."'".'wname'."','".'wlink'."','".'cclass'."','".'linkerror'."',".'this.id)"';
echo ' onmouseover="checklink('."'".'wname'."','".'wlink'."','".'linkerror'."',".'this.id)">';
echo 'Check Link';
echo '</button>';
// add div for messages
echo '<div id="linkerror"></div>';
//echo "A grid of ".$gelements." elements creates a matrix of ".$gw." by ".$gh."<br />";
createtable();
$test = "";
// Create $gh number of table records
for ($i=1; $i<=$gh; $i++)
    {
    echo '<tr>';
    for ($j=1; $j<=$gw; $j++)
        {
        $elements = explode("|",$data[abs($gw*($i-1)+$j-1)]);
// start td tag
        $tabdata = '<td';
// add color
        if ($asscol[rtrim($elements[2])] != "")
            {
            $tabdata = $tabdata.' style="font-size: 12px; background: '.$asscol[rtrim($elements[2])].';"';
            }
        else
            {
            $tabdata = $tabdata.' style="font-size: 12px;"';
            }
// add id
        $tabdata = $tabdata.' id="'.$i."-".$j.'" ';
// add class
        $tabdata = $tabdata.' class="gridcell"';
// add on click event
//        $tabdata = $tabdata.' onclick="alert('."'".rtrim($elements[1])."'".');"';
        $tabdata = $tabdata.' onclick="gotopage('."'".rtrim($elements[1])."'".');"';
// add mouse over event
        $tabdata = $tabdata.' onmouseover="changegcell(this.id,'.$gh.','.$gw.')" ';
// add mouse out event
        $tabdata = $tabdata.' onmouseout="changegback(this.id,'.$gh.','.$gw.')" ';
// end td start tag
        $tabdata = $tabdata.'>';
// add viewable data
        $tabdata = $tabdata.substr($elements[0],0,15);
// end anchor tag
// add on click event
//        $tabdata = $tabdata.'</a>';
// end td
        $tabdata = $tabdata.'</td>';
//        $tabdata = $tabdata.'-/td><br />';
        echo $tabdata;
//        if ($test==""){$test = $tabdata;}
        }
    }
echo "</tr></table>";
echo '<div id="gridmsg"></div>';
function definegrid($a)
    {
    $grem = 10;
    for ($i=$grem; $i>0; $i--)
        {
        $rem = fmod($a,$i);
        if ($rem<$grem)
            {
            $j = $i;
            $grem = $rem;
            }
        if ($grem==0)
            {
            $j = $i;
            break;
            }
        }
    return $j;
    }
function createtable()
    {
// create table tag
    echo '<table border="2" cellspacing="0" cellpadding="0" width="100%" height="100%">';
    }
?>

