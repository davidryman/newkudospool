<?php
createtable();
echo '<tr align="center" valign="middle">';
echo '<td width=200px>div</td>';
echo '<td width=200px><a onclick="seldate('."'".'thedate'."'".')">click to select date</a>';
echo '<td width=*><div id="thedate"></div></td>';
echo '</td>';
echo '</tr>';
echo '<tr align="Center" valign="Middle">';
echo '<td>span</td>';
echo '<td><a onclick="seldate('."'".'date2'."'".')">click to select date</a>';
echo '<td><span id="date2"></span></td>';
echo '</td>';
echo '</tr>';
echo '<tr align="Center" valign="Middle">';
echo '<td>p';
echo '</td>';
echo '<td><a onclick="seldate('."'".'date3'."'".')">click to select date</a></td>';
echo '<td><p id="date3"></p></td>';
echo '</tr>';
function createtable()
    {
    echo '<table border="1" cellspacing="0" cellpadding="0">';
    }
?>
