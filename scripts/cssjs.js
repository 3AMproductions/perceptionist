/*
 * cssjs
 * written by Christian Heilmann (http://icant.co.uk)
 * eases the dynamic application of CSS classes via DOM
 * parameters: action a, object o and class names c1 and c2 (c2 optional)
 * actions: swap exchanges c1 and c2 in object o
 *			add adds class c1 to object o
 *			remove removes class c1 from object o
 *			check tests if class c1 is applied to object o
 * example:	cssjs('swap',document.getElementById('foo'),'bar','baz');
 */

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

function sort(name)
{
	var title = name + "title";
	//var divs = document.getElementsByTagName("div");
	//for(var i=0; i < divs.length; i++)
	//{
	//	var div = divs[i];
	//	var id = div.id;
	//	if(
		
		
	var elements = document.getElementById('tablewrapper').getElementsByTagName('tr');
	for( i=0; i<elements.length; i=i+1 )
	{
		if( cssjs('check', elements[i], name, 'EMPTY') )
		{
			cssjs('remove', elements[i], 'hidden', 'EMPTY');
		}
		else
		{
			cssjs('add', elements[i], 'hidden', 'EMPTY');
		}
	}	
}

function sortOnLoad()
{
	var itshere = document.location.href;
	if ( itshere.indexOf("#") != -1 )
	{
		var index = itshere.indexOf("#") + 1;
		var name = itshere.substring(index);

		var title = name + "title";
		var elements = document.getElementById('tablewrapper').getElementsByTagName('tr');
			for( i=0; i<elements.length; i=i+1 )
			{
				if( cssjs('check', elements[i], name, 'EMPTY') )
				{
					cssjs('remove', elements[i], 'hidden', 'EMPTY');
				}
				else
				{
					cssjs('add', elements[i], 'hidden', 'EMPTY');
				}
			}
	}	
}

if (window.addEventListener) {
	//alert("IN THE IF IN CSSJS");
	window.addEventListener("load", sortOnLoad, false);
}
else{
	window.onload = function()
	{
		sortOnLoad();
	}
}