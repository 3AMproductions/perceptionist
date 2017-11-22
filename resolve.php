<?php
require_once('db.inc.php');

// error messages sent to this email address with these headers:
$to = "webmaster@example.com";
$headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com\r\nX-Mailer: PHP/".phpversion();

if(is_numeric($_REQUEST['call_id'])){
  $sql = 'UPDATE call SET resolved = 1 WHERE call_id = '.sql_scrub($_REQUEST['call_id']);
	$result = mysql_query($sql,$db);
	if(mysql_affected_rows($db)==1){// update successful
		header('location:'.$_REQUEST['refer']); exit;}
	elseif(mysql_affected_rows($db)==0){// update affected nothing
		$subject = "MySQL Error - Call Resolution";
		$msg = "The following SQL UPDATE query was moot:\n\t{$sql}";
		$msg .= "\n\nPossible Causes:\n";
		$msg .= "1)\tThe call_id was already set to 'resolved'.\n";
		$msg .= "2)\tThe call_id was invalid.";
		//mail($to,$subject,$msg,$headers);
		header('location:'.$_REQUEST['refer']); die;}
	elseif(mysql_affected_rows($db)>1){// update affected more than it should
		$subject = "MySQL Error - Call Resolution";
		$msg = "The following SQL UPDATE query affected ".mysql_affected_rows($db)." rows:\n\t{$sql}";
		$msg .= "\n\nPossible Causes:\n";
		$msg .= "1)\t".mysql_affected_rows($db)." call_id's were sent to 'resolve.php'.\n";
		$msg .= "2)\tThere are ".mysql_affected_rows($db)." calls with the same call_id in the 'call' table.\n";
		$msg .= "3)\tSome combination of 1 and 2.";
		//mail($to,$subject,$msg,$headers);
		header('location:'.$_REQUEST['refer']); die;}
	else{// update error
		$subject = "MySQL Error - Call Resolution";
		$msg = "The following SQL query failed:\n\t{$sql}\n".mysql_errno()."\t".mysql_error();
		//mail($to,$subject,$msg,$headers);
		header('location:'.$_REQUEST['refer']); die;}
}
else{// invalid call_id
	$subject = "Call Resolution Error";
	$msg = "Call resolution failed.\nCause:\tcall_id (".$_REQUEST['call_id'].") not numeric.";
	//mail($to,$subject,$msg,$headers);
	header('location:'.$_REQUEST['refer']);
	die;
}
?>