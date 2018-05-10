<?php
createtable();
echo '<tr>';
echo '<td rowspan="4">';
echo '<button onclick="register();">Register here</button>';
echo '</td></tr>';
echo '<tr><td>';
echo 'Alias: ';
echo '</td><td>';
echo '<input type="text" id="alias" name="alias" value="" />';
echo '</td></tr><tr><td>';
echo 'Password: ';
echo '</td><td>';
echo '<input type="password" id="pword" name="pword" value="" />';
echo '</td></tr>';
echo '<tr><td></td><td>';
echo '<button onclick="signin();">Sign in</button>';
echo '<button onclick="hideoverlay();">Cancel</button>';
echo '<div id="linkerror"></div>';
echo '</td></tr>';
echo '</table>';
function createtable()
    {
// create table tag
    echo '<table id="signin" border="3" cellspacing="0" cellpadding="0" width="50%">';
    }
?>
