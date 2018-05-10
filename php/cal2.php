<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

<title>Calender</title>
<script language="JavaScript" src="http://s87607151.onlinehome.us/public/js/drgen.js"></script>
<script language="JavaScript" src="http://s87607151.onlinehome.us/public/js/cal.js"></script>
<link rel=stylesheet type="text/css" href="http://s87607151.onlinehome.us/public/css/cal.css" />

</head>

<body onload="loadcal2('<?php echo $_REQUEST["destin"]; ?>')" onblur="self.focus();">
<div id="caldiv"></div>
<p id="seldate">No date selected</p>
<?php echo $_REQUEST["destin"]; ?>
<p onclick="alert(document.getElementById('cell10').onmouseover)">click</p>
<p id="textarea'></p>
<NOSCRIPT>Sorry Javascript not enabled</NOSCRIPT>
</body>

</html>
