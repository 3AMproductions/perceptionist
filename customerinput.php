<?php
include('db.inc.php');
session_start();

if(!is_null($submit)){
	$phone = strip_to_num($_POST['phone']);
	if(strlen($phone)==7) $phone = substr($phone,0,3).'-'.substr($phone,3);
	elseif(strlen($phone)==10) $phone = '('.substr($phone,0,3).') '.substr($phone,3,3).'-'.substr($phone,6);
	else $phone = "(000) 000-0000";
	$sql = "INSERT INTO customer VALUES (NULL,".sql_scrub($_POST['fname']).",".sql_scrub($_POST['mname']).",".sql_scrub($_POST['lname']).",".sql_scrub($_POST['street']).",".sql_scrub($_POST['city']).",".sql_scrub($_POST['state']).",".sql_scrub($_POST['zip']).",".sql_scrub($phone).")";
	$result = mysql_query($sql,$db);
	if($result){
		$id = mysql_insert_id($db);
		$sql = "INSERT INTO customer_bio VALUES (".$id.",".sql_scrub($_POST['nickname']).",".sql_scrub($_POST['birthday']).",".sql_scrub($_POST['hobbies']).",".sql_scrub($_POST['misc']).")";
		$result = mysql_query($sql,$db);
		if($result){
		//both inserts successfull
			header('location:customer.php?cid='.$id);
			exit;
		}
	}
	echo $sql;
	// else either insert failed
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
  <title>Perceptionist, Inc. - Form:Customer</title>
  <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
  <meta http-equiv="imagetoolbar" content="no" />
  <meta name="Description" content="Perceptionist, Inc. Bringing Everyone Together" />
  <meta name="Keywords" content="receptionist, call center, secretary, professional" />
  <meta name="Author" content="3AM Productions" />
  <meta name="Copyright" content="2005" />
  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="constant.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="customerinput.css" type="text/css" media="screen" />
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
<h1>Customer Input</h1>
This page is used to add customers to the database.
</div><!--navfill-->

<form id="infocontainer" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <h3 style="clear:both;">Personal Information</h3>
  <fieldset id="name">
  	<legend>Name:</legend>
  	<div class="row">
  		<input type="text" class="text" id="fname" name="fname" />
  		<input type="text" class="text" id="mname" name="mname" />
  		<input type="text" class="text" id="lname" name="lname" />
		</div>
  	<div class="lblrow">
  		<label for="fname" id="lblfname">First:</label>
  		<label for="mname" id="lblmname">Middle:</label>
  		<label for="lname" id="lbllname">Last:</label>
		</div>
  </fieldset>
  <fieldset id="address">
  	<legend>Address:</legend>
  	<div class="row">
  		<input type="text" class="text" id="street" name="street" />
		</div>
  	<div class="lblrow">
			<label for="street" id="lblstreet">Street:</label>
		</div>
  	<div class="row">
  		<input type="text" class="text" id="city" name="city" />
  		<input type="text" class="text" id="state" name="state" maxlength="2" />
  		<input type="text" class="text" id="zip" name="zip" maxlength="5" />
		</div>
  	<div class="lblrow">
			<label for="city" id="lblcity">City:</label>
  		<label for="state" id="lblstate">State:</label>
			<label for="zip" id="lblzip">Zip:</label>
  	</div>
  	<div class="row">
  		<input type="text" class="text" id="phone" name="phone" />
  	</div>
  	<div class="lblrow">
  		<label for="phone" id="lblphone">Phone:</label>
		</div>
  </fieldset>
  <h3 style="clear:both;">Biography Information</h3>
  <fieldset id="bio">
  	<legend>Other:</legend>
  	<div class="row">
  		<input type="text" class="text" id="nickname" name="nickname" />
  		<input type="text" class="text" id="birthday" name="birthday" />
		</div>
  	<div class="lblrow">
  		<label for="nickname" id="lblnickname">Nickname:</label>
  		<label for="birthday" id="lblbirthday">Date of Birth:</label>
		</div>
  	<div class="row">
  		<textarea id="hobbies" name="hobbies"></textarea>
		</div>
  	<div class="lblrow">
  		<label for="hobbies" id="lblhobbies">Hobbies:</label>
		</div>
  	<div class="row">
  		<textarea id="misc" name="misc"></textarea>
		</div>
  	<div class="lblrow">
  		<label for="misc" id="lblmisc">Misc:</label>
		</div>
  </fieldset>
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