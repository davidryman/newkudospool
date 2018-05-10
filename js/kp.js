// JavaScript Document
// Detect if the browser is IE or not.
// If it is not IE, we assume that the browser is NS.
var IE = document.all?true:false;
// If NS -- that is, !IE -- then set up for mouse capture
// if (!IE) document.captureEvents(Event.MOUSEMOVE)
if (!IE) 
	{
		document.addEventListener("move", mouseMove());
//		document.getElementsByName('game') addEventListener("mouseover",alert(this));
	}
	debugger;
var who = "";
var email = "";
var picks = ""; 
function mouseMove()
	{
// Set-up to use getMouseXY function onMouseMove
	document.onmousemove = getMouseXY;
	}
// Temporary variables to hold mouse x-y pos.s
var tempX = 0;
var tempY = 0;

// Main function to retrieve mouse x-y pos.s

function getMouseXY(e)
  {
  if (IE)
    { // grab the x-y pos.s if browser is IE
    tempX = event.clientX + document.body.scrollLeft;
    tempY = event.clientY + document.body.scrollTop;
    } 
  else 
    {  // grab the x-y pos.s if browser is NS
    tempX = e.pageX;
    tempY = e.pageY;
    }  
  // catch possible negative values in NS4
  if (tempX < 0){tempX = 0}
  if (tempY < 0){tempY = 0}  
  // show the position values in the form named Show
  // in the text fields named MouseX and MouseY
  try
    {
    document.getElementById('MouseX').value = tempX;
    document.getElementById('MouseY').value = tempY;
    }
  catch(err)
    {
    return false;
    }
  return true;
  }
function pageinit()
  {
debugger;
  dispCookie();
  dispsch();
  }
function dispsch()
  {
  var sy = document.getElementById("syear");
  var sw = document.getElementById("sweek");
  syear = sy.options[sy.selectedIndex].value;
  sweek = sw.options[sw.selectedIndex].value;
  getdata('./php/kpinit.php','&syear='+syear+'&sweek='+sweek,'NewGames','To '+sweek+'/'+syear);
  }
function hideoverlay()
  {
  document.getElementById('overlay').style.display = "none";
  }
function updpicks()
  {
debugger;
  var who = readCookie('alias');
  var wmail = readCookie('email');
	var wpicks = document.getElementsByClassName('games');
//	alert(wpicks.length+"\n"+wpicks[0].value);
  if (who == null)
    {
    alert('Please sign in so that we can record your picks');
    return;
    }
  addguess(who,wmail);
  }
function addguess(who,wmail)
    {
    errors = "";
    error = true;
    var error = valguess(who,'game'); // error returns results of false
//    alert(error);
    if (!error)
        {
        document.getElementById('linkerror').innerHTML = errors;
        tnfl = setTimeout("clearerror('linkerror')", 10000);
        }
    else
        {
//        document.getElementById('butt').style.visibility = "hidden";
// alert(who+"<>"+error)
        ajaxaddguess('./php/addnflguess.php',who,error);
        tnfl = setTimeout("clearerror('linkerror')", 10000);
        }
    }
function clearerror(what)
    {
    document.getElementById(what).innerHTML = "";
    }
function ajaxaddguess(php,who,error)
	{
		email = readCookie('email')
		var args = "?alias=" + who.value + "&email=''" + "&picks" + "100010001000";
	}
function valguess(who,wgame)
    {
    var results = "";
    for(i=0;i<17;i++) // replace 17 with actual count.
        {
        try
            {
            var testv=wgame.concat(i,"v");
            var testh=wgame.concat(i,"h");
            if (document.getElementById(testv).checked)
                {
                results = results + "0";
                }
            else if (document.getElementById(testh).checked)
                {
                results = results + "1";
                }
            else
                {
                errors = errors + "Please predict game " + eval(1+i) + "<br />";
                return false;
                }
            }
        catch(err)
            {
            return results;
            }
        }
    }
function signin()
  {
  var alias = document.getElementById('alias');
  var pword = document.getElementById('pword');
  var args = "&alias=" + alias.value + "&pword=" + pword.value;
  var aka = getdata('./php/authenticate.php',args,'Authentic','Authenticating '+alias.value);
	who = alias;
	document.getElementById('alias') = who;
  }
function register()
    {
    getdata('./php/register.php','','SignIn','Registration');
    }
function mshow(what)
  {
  document.getElementById('overlay').innerHTML = '<p id="wait">Loading..............</p>';
  switch(what.toUpperCase().substr(0,7))
    {
    case "SIGN IN":
      document.getElementById('overlay').style.display = "block";
      getdata('./php/signin.php','','SignIn','To sign in');
      break;
    case "OVERVIE":
      document.getElementById('overlay').style.display = "block";
      getdata('./php/overview.php','','SignIn','To Overview');
    case "SIGN OF":
      eraseCookie('alias');
      dispCookie();
    }
  }
// Authentic user?
function Authentic()
    {
    staterep();
    if (http.readyState == 4)
        {
        if (http.status == 200)
            {
            data = http.responseText;
            if (data != "")
                {
                document.getElementById('linkerror').innerHTML = data;
                if (data.substr(0,2)== "OK")
                    {
                    setCookie('alias',data.substr(3),'');
                    dispCookie();
                    hideoverlay();
//                    setTimeout("showdata('datashow','signin.php','')",2000);
                    }
                }
            }
          else
            {
            var ajaxdata = document.getElementById('ajaxstate');
            ajaxdata.value = http.status + '\n' +  ajaxdata.value;
            
            }
        }  
    }
function dispCookie()
  {
  var who = readCookie('alias');
  if (who != null)
    {
    document.getElementById('signedin').innerHTML = "Sign Off as "+who;
    document.getElementById('who').innerHTML = who;
    }
  else
    {
    document.getElementById('signedin').innerHTML = "Sign In";
    document.getElementById('who').innerHTML = "Anon";
    }
  }
function setCookie(name,value,days)
    {
	if (days)
        {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = ";expires="+date.toGMTString();
        }
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
    }

function readCookie(name)
    {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
        {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	return null;
    }

function eraseCookie(name)
  {
	setCookie(name,"",-1);
  }
function signup()
    {
    var alias = document.getElementById('alias');
    var pword = document.getElementById('pword');
    var wtext = document.getElementsByName('text');
    var args = "?alias=" + alias.value + "&pword=" + pword.value;
    for(i=0; i<wtext.length;i++)
        {
        args = args + "&" + wtext[i].id + "=" + wtext[i].value;
        }
//    alert(args);
    ajaxaddalias('./php/addalias.php',args);
    }
    
function gsel(this) 
	{ 
	alert(this);
	}
//
// ajax functions below    
// Display data in overlay div
function SignIn()
    {
    staterep();
    if (http.readyState == 4)
        {
        if (http.status == 200)
            {
            data = http.responseText;
            if (data != "")
                {
                document.getElementById('overlay').innerHTML = data;
                }
            }
          else
            {
            var ajaxdata = document.getElementById('ajaxstate');
            ajaxdata.value = http.status + '\n' +  ajaxdata.value;
            
            }
        }
    }
// Ajax - what to do with retrieved data
// Show new games grid 
function NewGames()
    {
    staterep();
    if (http.readyState == 4)
        {
        if (http.status == 200)
            {
            data = http.responseText;
            if (data != "")
                {
                document.getElementById('item').innerHTML = data;
                }
            }
          else
            {
            var ajaxdata = document.getElementById('ajaxstate');
            ajaxdata.value = http.status + '\n' +  ajaxdata.value;
            
            }
        }
    }
// Ajax routine to pass data from file
function getdata(script,args,handler,message)
    {
    var rand = Math.random();
    myrand = Math.floor(rand*99999999);
    var myurl = script + "?rand=" + myrand + args;
    http.open("POST", myurl, true);
    http.onreadystatechange = eval(handler);
    http.send(null);
    var ajaxdata = document.getElementById('ajaxstate');
    ajaxdata.value += message; 
    }
// Generic HTTP request set up
function getXMLHTTPRequest()
    {
    try
        {
        XMLHttp = new XMLHttpRequest();
        }
    catch(err1)
        {
        try
            {
            XMLHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
        catch(err2)
            {
            try
                {
                XMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
            catch(err3)
                {
                XMLHttp = false;
                }
            }
        }
    return XMLHttp;
    }
var http = getXMLHTTPRequest();
// Ajax routine to update activity in ajax window
function staterep()
    {
    var ajaxdata = document.getElementById('ajaxstate');
    if (http.readyState == 1)
      {
      ajaxdata.value = 'Loading' + '\n' +  ajaxdata.value;
      }
    if (http.readyState == 2)
      {
      ajaxdata.value = 'Loaded' + '\n' +  ajaxdata.value;
      }
    if (http.readyState == 3)
      {
    ajaxdata.value = 'Interactive' + '\n' +  ajaxdata.value;
      }
    if (http.readyState == 4)
      {
    ajaxdata.value = 'Complete' + '\n' +  ajaxdata.value;
      }
    }
    
