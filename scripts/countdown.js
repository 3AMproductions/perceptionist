/*
Script: CountDown Timer
Description: Counts down or up from a date (this is the non-XML version)
Author: Andrew Urquhart
Home: http://andrewu.co.uk/clj/countdown/
History:
20040117 0035UTC	v1		Andrew Urquhart		Created
20040119 1943UTC	v1.1	Andrew Urquhart		Made more accessible/easier to use
20040317 1548UTC	v1.2	Andrew Urquhart		Implemented a less intrusive error message
20040331 1408BST	v1.3	Andrew Urquhart		Attempts to add to the currently window.onload schedule, rather than overriding it
20050210 1558GMT	v1.4	Andrew Urquhart		Saves a short-cut to the each countdown Id element and re-uses that rather than continually calling getElementById - faster. Also reduced all nouns to short-versions to decrease size of script
20050216 0018GMT	v1.41	Andrew Urquhart		Added support for IE4
*/

// Update display (strContent, countdownId)
function CD_UD(s, id) {
  CD_OBJS[id].firstChild.nodeValue = s;
};

// Tick (countdownId, eventDate)
function CD_T(id, e) {
	var n	= new Date();
	var p	= 1E3 - n.getMilliseconds();
	setTimeout("CD_T('" + id + "', " + e + ")", p);
	CD_D(+n, id, e);
};

// Calculate time and invoke draw routine (dateNow, countdownId, eventDate)
function CD_D(n, id, e) {
	var ms = e - n;
	if (ms <= 0) ms *= -1;
	//var d = Math.floor(ms / 864E5);
	//ms -= d * 864E5;
	var h = Math.floor(ms / 36E5);
	ms -= h * 36E5;
	var m = Math.floor(ms / 6E4);
	ms -= m * 6E4;
	var s = Math.floor(ms / 1E3);
	CD_UD(/*CD_ZP(d) + ":" + */CD_ZP(h) + ":" + CD_ZP(m) + ":" + CD_ZP(s), id);
};

// Prefix single integers with a zero
function CD_ZP(i) {
	return (i<10 ? "0" + i : i);
};

// Initialisation
function CD_Init() {
	var pref = "countdown";
	var objH = 1; // temp boolean true value
	if (document.getElementById) {
		for (var i=1; objH; ++i) {
			var id	= pref + i;
			objH	= document.getElementById(id);

			if (objH && (objH.firstChild.nodeType) != 'undefined') {
				var s	= objH.firstChild.nodeValue;
				var dt = new Date(s.substr(0,4),s.substr(4,2)-1,s.substr(6,2),s.substr(8,2),s.substr(10,2),s.substr(12,2),00);
				if (!isNaN(dt)) {
					CD_OBJS[id] = objH; // Store global reference to countdown element object
					CD_T(id, dt.valueOf());
					if (objH.style) {
						objH.style.visibility = "visible";
					}
				}
				else {
					objH.firstChild.nodeValue = s + "<a href=\"http://andrewu.co.uk/clj/countdown/\" title=\"Countdown Error: Invalid date format used, check documentation (see link)\">*</a>";
				}
			}
		}
	}
};

var CD_OBJS = new Object();

// Try not to commandeer the default onload handler if possible
if (window.attachEvent) {
	//alert("IN THE ELSE IN COUNTDOWN01");
	window.attachEvent('onload', CD_Init);
}
else if (window.addEventListener) {
	//alert("IN THE ELSE IN COUNTDOWN02");
	window.addEventListener("load", CD_Init, false);
}
else {
	//alert("IN THE ELSE IN COUNTDOWN03");
	window.onload = CD_Init;
}
