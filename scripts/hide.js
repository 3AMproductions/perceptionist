function cssjs(a,o,c1,c2)
{
	switch (a){
		case 'swap':
			o.className=!cssjs('check',o,c1)?o.className.replace(c2,c1):o.className.replace(c1,c2);
		break;
		case 'add':
			if(!cssjs('check',o,c1)){o.className+=o.className?' '+c1:c1;}
		break;
		case 'remove':
			var rep=o.className.match(' '+c1)?' '+c1:c1;
			o.className=o.className.replace(rep,'');
		break;
		case 'check':
			return new RegExp('\\b'+c1+'\\b').test(o.className)
		break;
	}
}

function fixLinks()
{
  if (!document.getElementsByTagName) return null;
  var server = document.location.hostname;
  var anchors = document.getElementsByTagName("a");
  for(var i=0; i < anchors.length; i++)
  {
    var a = anchors[i];
    var href = a.href;
    var id = a.id;
    var title = a.title;
    if ((href.indexOf("#") != -1) && (href.indexOf("header") == -1)) { // jump ref
      var index = href.indexOf("#") + 1;
      href = "javascript:show('" + href.substring(index) + "');";
      a.setAttribute("href",href);
    }
  }
}

function hideDivs(exempt)
{
  if (!document.getElementsByTagName) return null;
  //alert("PAST");
  if (!exempt) exempt = "";
  var divs = document.getElementsByTagName("div");
  for(var i=0; i < divs.length; i++)
  {
    var div = divs[i];
    var id = div.id;
    //alert("DIV= " + div + ", ID= " + id);
    if ((id != "header") && (id != "footer") && (id != "container") && (id != "titlebar") && (id != "main") && (id != "nav") && (id != "navfill") && (id != "innerfooter") && (id != "pie") && (id != "") && (id != exempt))
    {
      cssjs('add',div,'hidden','EMPTY');
      //div.className = "hidden";
    }
  }
}

function show(what)
{
  if (!document.getElementById) return null;
  showWhat = document.getElementById(what);
  //alert(what.indexOf('complaints'));
  if (what.indexOf('complaints') == -1 ){
	cssjs('remove', document.getElementById(what), 'hidden', 'EMPTY');
	//showWhat.style.display = "block";
	hideDivs(what);
  }
  if (what.indexOf('complaints') != -1 ){
	//cssjs('remove', document.getElementById(what), 'hidden', 'EMPTY');
	//showWhat.style.display = "block";
	hideDivs();
	cssjs('remove', document.getElementById('repair'), 'hidden', 'EMPTY');
	cssjs('remove', document.getElementById('cservice'), 'hidden', 'EMPTY');
  }
}

function ifComplaints()
{
	if (!document.getElementById) return null;
	var itshere = document.location.href;
	if ((itshere.indexOf("#") != -1) && (itshere.indexOf("complaints") != -1))
	{
		cssjs('remove', document.getElementById('repair'), 'hidden', 'EMPTY');
		cssjs('remove', document.getElementById('cservice'), 'hidden', 'EMPTY');
	}
}

function ifUnresolved()
{
	if (!document.getElementById) return null;
	var itshere = document.location.href;
	if ((itshere.indexOf("#") != -1) && (itshere.indexOf("unresolved") != -1))
	{
		cssjs('remove', document.getElementById('unresolved'), 'hidden', 'EMPTY');
	}
}

window.onload = function()
{
  fixLinks();
  //alert("HIDING DIVS NOW...");
  hideDivs();
  //alert("ALL DIVS SHOULD BE GONE");
  ifComplaints();
  ifUnresolved();
}