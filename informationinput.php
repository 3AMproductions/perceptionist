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
  <title>Perceptionist, Inc. - Form:Information</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="informationinput.css" type="text/css" media="screen" />
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
<h1>Information Form</h1>
This page is used to log a question a customer asked about our client company which we were not able to answer. Choose the customer from the drop down menu or if they are not in the menu, type their name. Choose the question type from its drop down menu. Then type the question.
</div><!--navfill-->

<form id="infocontainer" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset id="customer"><legend>Customer:</legend>
    <div class="row">
  		<label for="existing">Existing:</label>
  		<select id="existing" name="customer_id">
    		<optgroup label="Customer Name">
      		<?php $result = mysql_query("SELECT * FROM customer",$db); while($row = @mysql_fetch_assoc($result)) echo '<option>'.$row['fname'].' '.$row['lname'].'</option>'."\n"; ?>
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
  <fieldset id="information"><legend>Information:</legend>
    <div class="row">
  		<label for="type">Type:</label>
  		<select id="type" name="info_type">
    		<optgroup label="Information Type">
      		<option value="1">Information Type 1</option>
      		<option value="2">Information Type 2</option>
      		<option value="3">Information Type 3</option>
    		</optgroup>
    		<optgroup label="Other">
      		<option value="new">New Type</option>
    		</optgroup>
  		</select>
		</div>
    <div class="row">or</div>
    <div class="row">
  		<label for="other">Other:</label>
  		<input type="text" name="new_info_type" id="other" class="text" />
		</div>
  </fieldset><!--employee-->
	<fieldset id="question"><legend>Question:</legend>
  	<textarea name="question"></textarea>
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