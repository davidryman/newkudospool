<?php
createtable();
echo '<tr>';
echo '<td colspan="3" align="center">';
echo '<h3>Identify Yourself</h3>';
echo '</td></tr>';
echo '<tr><td align="right">';
echo '<b>Alias:</b>';
echo '</td><td>';
echo '<input type="text" id="alias" name="alias" value="" />';
echo '</td><td>';
echo 'Username, or Login whichever you prefer.';
echo '</td></tr><tr>';
echo '<td align="right">';
echo '<b>Password:</b>';
echo '</td><td>';
echo '<input type="password" id="pword" name="pword" value="" />';
echo '</td><td>';
echo 'No restrictions, you can leave it blank, but how secure is that?';
echo '</td></tr><tr>';
echo '<td align="right">';
echo '<b>Real Name:</b>';
echo '</td><td>';
echo '<input type="text" id="aname" name="text" value="" />';
echo '</td>Unless you really want to be anonymous.<td>';
echo '';
echo '</td></tr>';
echo '<td align="right">';
echo '<b>Email address:</b>';
echo '</td><td>';
echo '<input type="text" id="aemail" name="text" value="" />';
echo '</td>In case I need to send you something.<td>';
echo '';
echo '</td></tr>';
echo '<td align="right">';
echo '<b>Location:</b>';
echo '</td><td>';
echo '<input type="text" id="aloc" name="text" value="" />';
echo '</td><td>';
echo 'eg Planet Earth or NYNY';
echo '</td></tr>';
echo '<td align="right">';
echo '<b>Sex:</b>';
echo '</td><td>';
echo '<input type="text" id="asex" name="text" value="" />';
echo '</td><td>';
echo 'Helps with demographics. M, F, Yes Please, are all acceptable';
echo '</td></tr>';


echo '<td align="right">';
echo '<b>Tell me something I do not know:</b>';
echo '</td><td>';
echo '<input type="text" id="acom" name="text" value="" />';
echo '</td><td>';
echo 'Anything or nothing';
echo '</td></tr>';

echo '<tr><td></td><td>';
echo '<button onclick="signup();">This is who I am!</button>';
echo '</td><td>';
echo '<div id="linkerror">Let me see if I have a vacancy.<div>';
echo '</td></tr>';
echo '</table>';
function createtable()
    {
// create table tag
    echo '<table id="register" border="0" cellspacing="0" cellpadding="0" width="50%">';
    }
?>
