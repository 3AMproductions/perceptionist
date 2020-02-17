<?php
include('db.inc.php');
session_start();
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") || $_GET['xml']=="true") {
  header("Content-type: application/xhtml+xml");
	echo '<?xml version="1.0" encoding="utf-8"?>'."\n";}
else {header("Content-type: text/html");}

if(!is_null($_REQUEST['coid']) and is_numeric($_REQUEST['coid'])){
  $coid = $_REQUEST['coid'];
	$_SESSION['coid'] = $_REQUEST['coid'];}
elseif(!is_null($_SESSION['coid']) and is_numeric($_SESSION['coid'])) $coid = $_SESSION['coid'];
else $coid = NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Perceptionist, Inc. - Contact</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="contact.css" type="text/css" media="screen" />
</head>
<body>
<div id="header"></div><!--Header-->
<div id="container">
<div id="titlebar"></div><!--titlebar-->
<div id="main">
<ul id="nav">
	<li><a href="index.php" accesskey="h"><em>h</em>ome</a></li>
	<li><a href="report.php#complaints" accesskey="c"><em>c</em>omplaints</a></li>
	<li><a href="report.php#unresolved" accesskey="u"><em>u</em>nresolved calls</a></li>
	<li><a href="contact.php" accesskey="o">c<em>o</em>ntact list</a></li>
	<li><a href="report.php" accesskey="r"><em>r</em>eport</a></li>
</ul> <!--nav-->
<div id="navfill">
<h1>Contact List</h1>
This page contains a listing of all customers on record for your company. Clicking on their name will take you to a page containing their contact information as well as their biographical information.
</div><!--navfill-->
<div id="tablewrapper" style="clear:both;" >
  <table>
    <tbody>
<?php
if(!is_null($coid)) $sql = 'SELECT * FROM customer LEFT JOIN customer_bio ON (customer.customer_id = customer_bio.customer_id) LEFT JOIN call ON (call.customer_id = customer.customer_id) WHERE company_id = '.$coid.' ORDER BY customer.fname';
else $sql = 'SELECT * FROM customer LEFT JOIN customer_bio ON (customer.customer_id = customer_bio.customer_id) ORDER BY customer.fname';
$result = mysqli_query($db, $sql);
while($bio = @mysqli_fetch_assoc($result))
{
  echo '	    <tr>'."\n";
	echo '  	    <td class="one"><a href="customer.php?cid='.$bio['customer_id'].'">'.$bio['fname'].' '.$bio['lname'].'</a></td>'."\n";
	echo '				<td class="two">'.$bio['address'].'</td>'."\n";
	echo '				<td class="three">'.$bio['phone'].'</td>'."\n";
	echo'			</tr>'."\n";
}
?>
		</tbody>
	</table>
</div><!--tablewrapper-->
<a href="http://student.cob.ohio-state.edu/velasquez_13">
  <span id="innerfooter">
		<span class="ifootheader">a 3AM production</span>
	  <span class="ifootertop">Does your company have a web presence?</span>
		<span class="ifooterbottom">Click here to find out why you need one and how 3AM can help you get there...</span>
	</span><!--innerfooter-->
</a>
</div> <!-- main -->
</div><!-- container -->
<div id="footer"></div><!--footer-->
</body>
</html>