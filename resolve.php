<?php
require_once('db.inc.php');

// error messages sent to this email address with these headers:
$to = "webmaster@example.com";
$headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com\r\nX-Mailer: PHP/".phpversion();

if(is_numeric($_REQUEST['call_id'])){
  $sql = 'UPDATE call SET resolved = 1 WHERE call_id = '.sql_scrub($_REQUEST['call_id']);
  $result = mysqli_query($db, $sql);
  if(mysqli_affected_rows($db)==1){// update successful
    header('location:'.$_REQUEST['refer']); exit;}
  elseif(mysqli_affected_rows($db)==0){// update affected nothing
    $subject = "mysql Error - Call Resolution";
    $msg = "The following SQL UPDATE query was moot:\n\t{$sql}";
    $msg .= "\n\nPossible Causes:\n";
    $msg .= "1)\tThe call_id was already set to 'resolved'.\n";
    $msg .= "2)\tThe call_id was invalid.";
    //mail($to,$subject,$msg,$headers);
    header('location:'.$_REQUEST['refer']); die;}
  elseif(mysqli_affected_rows($db)>1){// update affected more than it should
    $subject = "mysql Error - Call Resolution";
    $msg = "The following SQL UPDATE query affected ".mysqli_affected_rows($db)." rows:\n\t{$sql}";
    $msg .= "\n\nPossible Causes:\n";
    $msg .= "1)\t".mysqli_affected_rows($db)." call_id's were sent to 'resolve.php'.\n";
    $msg .= "2)\tThere are ".mysqli_affected_rows($db)." calls with the same call_id in the 'call' table.\n";
    $msg .= "3)\tSome combination of 1 and 2.";
    //mail($to,$subject,$msg,$headers);
    header('location:'.$_REQUEST['refer']); die;}
  else{// update error
    $subject = "mysql Error - Call Resolution";
    $msg = "The following SQL query failed:\n\t{$sql}\n".mysqli_errno($GLOBALS["___mysqli_ston"])."\t".mysqli_error($GLOBALS["___mysqli_ston"]);
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
