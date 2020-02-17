<?php
include('db.inc.php');
session_start();

if(!is_null($submit)){
	print_r($_POST);
	exit;
}
else{
  if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") || $_GET['xml']=="true") {
    header("Content-type: application/xhtml+xml");
  	echo '<?xml version="1.0" encoding="utf-8"?>'."\n";}
  else {header("Content-type: text/html");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title>Perceptionist, Inc. - Form:Complaint</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="complaintinput.css" type="text/css" media="screen" />
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
<h1>Complaint Input</h1>
This page is used to log a complaint given by customer. Choose the Customer and Employee their complaint is about from their respective drop down menus. If the customer's name does not appear, simply type in their first and last names. If the complaint is for the company in general choose 'TO ALL' in the employee menu. Mark the type of complaint then enter the complaint.
</div><!--navfill-->

<form id="infocontainer" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset id="customer">
    <legend>Customer:</legend>
    <div class="row">
  		<label for="existing">Existing:</label>
  		<select id="existing" name="customer_id">
    		<optgroup label="Customer Name">
      		<?php $result = mysqli_query($db, "SELECT * FROM customer"); while($row = @mysqli_fetch_assoc($result)) echo '<option value="'.$row['customer_id'].'">'.$row['fname'].' '.$row['lname'].'</option>'."\n"; ?>
				</optgroup>
    		<optgroup label="Other">
      		<option value="new">New Customer</option>
    		</optgroup>
  		</select>
		</div>
    <div class="row">or</div>
    <div class="row">
  		<label for="first">New:</label>
  		<input type="text" id="first" name="new_customer_fname" class="text" />
  		<input type="text" id="last" name="new_customer_lname" class="text" />
		</div>
    <div class="row">
  		<label id="lblfirst" for="first">First</label>
  		<label id="lbllast" for="last">Last</label>
		</div>
  </fieldset><!--customer-->
  <fieldset id="employee"><legend>Employee:</legend>
    <div class="row">
  		<label for="employee_name">Employee Name:</label>
  		<select id="employee_name" name="employee_id">
    		<optgroup label="Employee Name">
      		<?php $result = mysqli_query($db, "SELECT * FROM employee"); while($row = @mysqli_fetch_assoc($result)) echo '<option value="'.$row['employee_id'].'">'.$row['employee_fname'].' '.$row['employee_lname'].'</option>'."\n"; ?>
    		</optgroup>
    		<optgroup label="Other">
      		<option value="all">To All</option>
    		</optgroup>
  		</select>
		</div>
  </fieldset><!--employee-->
  <fieldset id="complaint"><legend>Complaint:</legend>
    <input type="radio" id="repair" name="type" value="1" checked="checked" />
		<label for="repair">Repair</label>
  	<input type="radio" id="service" name="type" value="2" />
		<label for="service">Customer Service</label>
    <textarea name="complaint"></textarea>
  </fieldset><!--bio-->
	<fieldset id="submit">
		<input type="submit" name="submit" value=" SUBMIT " />
	</fieldset>
</form><!--infocontainer-->

<a href="http://student.cob.ohio-state.edu/velasquez_13">
  <span id="innerfooter">
	  <span class="ifootertop">Would you like a personal web presence?</span>
		<span class="ifooterbottom">Click here to find out why you need one and how 3AM can help you get there...</span>
	</span><!--innerfooter-->
</a>
</div> <!-- main -->
</div><!-- container -->
<div id="footer"></div><!--footer-->
</body>
</html>
<?php }//end else block ?>