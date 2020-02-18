<?php
include('db.inc.php');
session_start();
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") || $_GET['xml']=="true") {
  header("Content-type: application/xhtml+xml");
  echo '<?xml version="1.0" encoding="utf-8"?>'."\n";}
else {header("Content-type: text/html");}

if(isset($_REQUEST['cid']) and is_numeric($_REQUEST['cid'])){
  $cid = $_REQUEST['cid'];
  $_SESSION['cid'] = $_REQUEST['cid'];}
  //elseif(!is_null($_SESSION['cid']) and is_numeric($_SESSION['cid'])) $cid = $_SESSION['cid'];
else $cid = NULL;

if(isset($_REQUEST['call_id']) and is_numeric($_REQUEST['call_id'])){
  $call_id = $_REQUEST['call_id'];
  $_SESSION['call_id'] = $_REQUEST['call_id'];}
  //elseif(!is_null($_SESSION['call_id']) and is_numeric($_SESSION['call_id'])) $call_id = $_SESSION['call_id'];
else $call_id = NULL;

if(isset($_REQUEST['coid']) and is_numeric($_REQUEST['coid'])){
  $coid = $_REQUEST['coid'];
  $_SESSION['coid'] = $_REQUEST['coid'];}
elseif(isset($_SESSION['coid']) and is_numeric($_SESSION['coid'])) $coid = $_SESSION['coid'];
else $coid = NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Perceptionist, Inc. - Customer Information</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="customer.css" type="text/css" media="screen" />
  <script type="text/javascript" src="scripts/countdown.js" defer="defer"></script>
</head>
<body>
<div id="header"></div><!--Header-->
<div id="container">
<div id="titlebar"></div><!--titlebar-->
<br style="clear:both;" />
<div id="main">
<ul id="nav">
  <li><a href="perception.php" accesskey="h"><em>h</em>ome</a></li>
  <li><a href="report.php#complaints" accesskey="c"><em>c</em>omplaints</a></li>
  <li><a href="report.php#unresolved" accesskey="u"><em>u</em>nresolved calls</a></li>
  <li><a href="contact.php" accesskey="o">c<em>o</em>ntact list</a></li>
  <li><a href="report.php" accesskey="r"><em>r</em>eport</a></li>
</ul> <!--nav-->
<div id="navfill">
<h1>Customer Information</h1>
This page contains information concerning one particular customer. It includes he basics like name, address and phone number. But it also contains an in-depth biography of the customer along with their request to give a more personalized experience. The <b>Perceptionist Call Flow</b> showing the path this customer took to appear on this page is also shown.
</div><!--navfill-->
<br style="clear:both;" />
<?php
if(!is_null($cid))
{
  $sql = 'SELECT *,date_format(customer_bio.birthday, \'%M %D, %Y\') AS bdate FROM customer LEFT JOIN customer_bio ON (customer.customer_id = customer_bio.customer_id) WHERE (customer.customer_id = '.$cid.')';
  $result = mysqli_query($db, $sql);
  if($bio = @mysqli_fetch_assoc($result))
  {
    if(!is_null($call_id))
    {
      $company = (!is_null($coid)? " AND call.company_id = $coid" : "");
      $sql = 'SELECT * FROM call LEFT JOIN flow ON (call.call_id = flow.call_id) LEFT JOIN employee ON (flow.employee_id = employee.employee_id) LEFT JOIN customer ON (customer.customer_id = call.customer_id) WHERE call.call_id = '.$call_id.$company.' AND (call.resolved != 1) ORDER BY call.call_time';
      $result2 = mysqli_query($db, $sql);
      if($call = @mysqli_fetch_assoc($result2))
        echo '<div id="time">Time since this call: -<span id="countdown1">'.$call['call_time'].'</span></div><!--time-->'."\n";
    }
    echo '<div id="infocontainer">'."\n";
    echo '<h3>'.$bio['fname'].' '.$bio['lname'].'</h3>'."\n";
    echo '<address id="phone">'.$bio['phone'].'</address>'."\n";
    echo '<address>'.$bio['address'].'<br />'.$bio['city'].', '.$bio['state'].' '.$bio['zip'].'</address>'."\n";
    if(!is_null($call_id) and @mysqli_data_seek($result2, 0))
    {
      if($call = @mysqli_fetch_assoc($result2)){
        echo '<dl id="request">'."\n";
        echo '  <dt>Request:</dt><dd>'.wordwrap($call['request'], 75, " ", 1).'</dd>'."\n";
        echo '  <dt>Perceptionist Call Flow:</dt>'."\n";
        echo '	<dd><a id="resolve_call" href="resolve.php?call_id='.$call['call_id'].'&amp;refer='.$PHP_SELF.'?cid='.$cid.'" title="Click to resolve this call." onclick="return confirm(\'Click \\\'OK\\\' if '.$call['fname'].' '.$call['lname'].'\\\'s call has been resolved.\');"><img src="images/resolve2.gif" alt="Resolve Call" onmouseover="this.src=\'images/resolve2hover.gif\'" onmouseout="this.src=\'images/resolve2.gif\'" /></a>';
        echo $bio['fname'].' (Customer) --- Perceptionist --- <a href="perception.php?eid='.$call['employee_id'].'">'.$call['employee_fname'].'</a>';
        while($call = @mysqli_fetch_assoc($result2)) echo ' --- <a href="perception.php?eid='.$call['employee_id'].'">'.$call['employee_fname'].'</a>';
        echo "</dd>\n</dl>\n";
      }
    }
    if(!is_null($coid)) $company = ' AND (call.company_id = '.$coid.')';
    else $company = ''; 
    if(!is_null($call_id)){
      $sql = 'SELECT * FROM call WHERE call.resolved != 1 AND customer_id = '.$cid.' AND call_id != '.$call_id.$company;
      $counter = 2;}
    else{
      $sql = 'SELECT * FROM call WHERE call.resolved != 1 AND customer_id = '.$cid.$company;
      $counter = 1;}			
      $result2 = mysqli_query($db, $sql);
    if($call = @mysqli_fetch_assoc($result2)){
      echo '<div id="tablewrapper">'."\n";
      echo '<table id="calls">'."\n";
      echo '<thead><tr><th colspan="4">! '.$bio['fname'].' has '.mysqli_num_rows($result2).' other unresolved call'.(mysqli_num_rows($result2)>1? 's' : '').'.</th></tr></thead>';
      echo '<tbody>'."\n";
      @mysqli_data_seek($result2, 0);
      while($call = @mysqli_fetch_assoc($result2)){
        // trim request
        $request = $call['request'];
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
        echo "<tr>\n";
        echo ' <td class="one"><a href="'.$PHP_SELF.'?cid='.$call['customer_id'].'&amp;call_id='.$call['call_id'].'">'.$bio['fname'].'</a></td>'."\n";
        echo ' <td class="two">Request: '.$request.'</td>'."\n";
        echo ' <td class="three">&nbsp; -<span id="countdown'.$counter.'">'.$call['call_time'].'</span></td>'."\n";
        //echo ' <td class="four"><a href="resolve.php?call_id='.$call['call_id'].'&amp;refer='.$PHP_SELF.'" title="Click to resolve this call." onclick="return confirm(\'Click \\\'OK\\\' if '.$bio['fname'].' '.$bio['lname'].'\\\'s call has been resolved.\');"><img src="images/resolve.gif" alt="Resolve Call" /></a></td>';
        echo '</tr>'."\n";
        $counter++;
      }
      echo '</tbody>'."\n";
      echo '</table>'."\n";
      echo '</div>'."\n";
    }
    echo '<h4>Bio Info</h4>'."\n";
    echo '<dl id="bio">'."\n";
    echo '  <dt>Nickname:</dt><dd>"'.$bio['nickname'].'"</dd>'."\n";
    echo '	<dt>Birthday:</dt><dd>'.$bio['bdate'].'</dd>'."\n";
    echo '	<dt>Hobbies:</dt><dd>'.$bio['hobbies'].'</dd>'."\n";
    echo '	<dt>Miscellaneous:</dt><dd>'.$bio['misc'].'</dd>'."\n";
    echo '</dl><!--bio-->'."\n";
    echo '</div><!--infocontainer-->'."\n";
  }
}
?>
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
