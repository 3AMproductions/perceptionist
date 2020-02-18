<?php
include('db.inc.php');
session_start();
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") || $_GET['xml']=="true") {
  header("Content-type: application/xhtml+xml");
  echo '<?xml version="1.0" encoding="utf-8"?>'."\n";}
else {header("Content-type: text/html");}

if(isset($_REQUEST['eid']) and is_numeric($_REQUEST['eid'])){
  $eid = $_REQUEST['eid'];
  $_SESSION['eid'] = $_REQUEST['eid'];}
elseif(isset($_SESSION['eid']) and is_numeric($_SESSION['eid']) and $_REQUEST['eid'] != "all") $eid = $_SESSION['eid'];
else $eid = NULL;

if(isset($_REQUEST['coid']) and is_numeric($_REQUEST['coid'])){
  $coid = $_REQUEST['coid'];
  $_SESSION['coid'] = $_REQUEST['coid'];}
elseif(isset($_SESSION['coid']) and is_numeric($_SESSION['coid']) and $_REQUEST['coid'] != "all") $coid = $_SESSION['coid'];
else $coid = NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Perceptionist, Inc. - Home</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="perceptionist.css" type="text/css" media="screen" />
  <script type="text/javascript" src="scripts/countdown.js"></script>
  <!--<script type="text/javascript" src="scripts/login.js"></script>
  <script type="text/javascript" src="scripts/cssjs.js"></script>-->
</head>
<body>
<div id="header"></div> <!--Header-->
<div id="container">
<div id="titlebar"></div> <!--titlebar-->
<div id="main">
<div id="navfill">
<h1>Money At Your Fingertips</h1>
This page contains information regarding those customers which were not able to reach a customer representative at your organization. It lists their name, the reason they called and the time that has elapsed since last contact. Please click on their name for more information. Clicking on the dollar sign will mark a call as resolved and remove it form this page.
</div><!--navfill-->

<ul id="nav">
  <li><a href="index.php" accesskey="h"><em>h</em>ome</a></li>
  <li><a href="report.php#complaints" accesskey="c"><em>c</em>omplaints</a></li>
  <li><a href="report.php#unresolved" accesskey="u"><em>u</em>nresolved calls</a></li>
  <li><a href="contact.php" accesskey="o">c<em>o</em>ntact list</a></li>
  <li><a href="report.php" accesskey="r"><em>r</em>eport</a></li>
</ul> <!--nav-->

<br style="clear:both;" />
<!--<span id="username"></span>-->
<div id="tablewrapper">
<table id="calls">
<tbody>
<?php
if(!is_null($eid)) $sort = ' AND (flow.employee_id = '.sql_scrub($eid).')';
else $sort = '';
if(!is_null($coid)) $company = '(call.company_id = '.$coid.') AND ';
else $company = ''; 
//$sql = 'SELECT DISTINCT call.call_id,flow.employee_id,customer.fname,customer.lname,call.request,customer.customer_id,TIME_FORMAT(call.call_time,\'%D:%T\') AS time FROM customer LEFT JOIN call ON (customer.customer_id = call.customer_id) LEFT JOIN flow ON (call.call_id = flow.call_id) WHERE '.$company.'(call.resolved != 1) AND (TO_DAYS(NOW()) - TO_DAYS(call.call_time) <= 1)'.$sort.' GROUP BY call.call_id ORDER BY call.call_time';
//$sql = 'SELECT DISTINCT call.call_id,flow.employee_id,customer.fname,customer.lname,call.request,customer.customer_id,call.call_time FROM customer LEFT JOIN call ON (customer.customer_id = call.customer_id) LEFT JOIN flow ON (call.call_id = flow.call_id) WHERE '.$company.'(call.resolved != 1) AND (TO_DAYS(NOW()) - TO_DAYS(call.call_time) <= 1)'.$sort.' GROUP BY call.call_id ORDER BY call.call_time';
$sql = 'SELECT DISTINCT call.call_id,flow.employee_id,customer.fname,customer.lname,call.request,customer.customer_id,call.call_time FROM customer LEFT JOIN `call` ON (customer.customer_id = call.customer_id) LEFT JOIN flow ON (call.call_id = flow.call_id)';// WHERE '.$company.'(call.resolved != 1) '.$sort.' GROUP BY call.call_id ORDER BY call.call_time';
$result = mysqli_query($db, $sql);
$counter = 1;
while ($row = @mysqli_fetch_assoc($result))
{
  // trim request
  $request = $row['request'];
  if(strlen($request) > 50){
    $request = substr($request,0,50);
    $pos = strrpos ($request,'.');
    if($pos !== false) $request = substr($request,0,$pos+1 );
    else {
      $pos = strrpos ($request,' ');
      if($pos !== false) $request = substr($request,0,$pos) . '...';
      else $request .= '...';
    } 
  }
  // format call time
  $time = $row['call_time']; $d = substr($time,6,2); $h = substr($time,8,2); $m = substr($time,10,2); $s = substr($time,12,2); $time = "$d:$h:$m:$s";

  echo "<tr>\n";
  echo ' <td class="one"><a href="customer.php?cid='.$row['customer_id'].'&amp;call_id='.$row['call_id'].'">'.$row['fname'].' '.$row['lname'].'</a></td>'."\n";
  echo ' <td class="two">Request: '.$request.'</td>'."\n";
  echo ' <td class="three">&nbsp; -<span id="countdown'.$counter.'">'.$row['call_time'].'</span></td>'."\n";
  echo ' <td class="four"><a href="resolve.php?call_id='.$row['call_id'].'" title="Click to resolve this call." onclick="return confirm(\'Click \\\'OK\\\' if '.$row['fname'].' '.$row['lname'].'\\\'s call has been resolved.\');"><img src="images/resolve.gif" alt="Resolve Call" /></a></td>';
  echo '</tr>'."\n";
  $counter++;
}
?>
</tbody>
</table>
</div><!--tablewrapper-->
<div id="sort">Sort By:
<?php
if(!is_null($coid)) $company = ' WHERE employee.company_id = '.sql_scrub($coid);
else $company = ''; 
$sql = 'SELECT employee.employee_id,employee.employee_fname FROM employee'.$company;
$result = mysqli_query($db, $sql);
while($row = @mysqli_fetch_assoc($result)){
  echo '<a href="?eid='.$row['employee_id'].'">'.$row['employee_fname'].'</a> | '."\n";
}
echo '<a href="?eid=all">SHOW ALL</a>'."\n";
// TEMP BELOW ***********************************
echo '<div>Choose Company: ';
$result = mysqli_query($db, 'SELECT company_id FROM company');
while($row = @mysqli_fetch_assoc($result)){echo '<a href="?coid='.$row['company_id'].'">CO.'.$row['company_id'].'</a> | ';}
echo '<a href="?coid=all">SHOW ALL</a></div>';
// END TEMP *************************************
?>
</div><!--sort-->
<a href="http://student.cob.ohio-state.edu/velasquez_13">
  <span id="innerfooter">
    <span class="ifootertop">Does your compnay have a web presence?</span>
    <span class="ifooterbottom">Click here to find out why you need one and how 3AM can help you get there...</span>
  </span><!--innerfooter-->
</a>
</div><!-- main -->
</div><!-- container -->
<div id="footer"></div><!--footer-->
</body>
</html>
