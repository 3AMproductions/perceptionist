<?php
function strip_to_num($str)
{
 	if(strlen($str)>0)
	{
	  if(is_numeric($str{0})) return $str{0} . strip_to_num(substr($str,1));
		else return strip_to_num(substr($str,1));
	}
}

function sql_scrub($query)
{
  if (!$query || $query=="" || $query===0 || is_null($query)) return "NULL";
  // Stripslashes
  if (get_magic_quotes_gpc()) $query = stripslashes($query);
  // Quote if not integer
  if (!is_numeric($query)) $query = "'" . mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $query) . "'";
  return $query;
}

function sql_scrub_noquote($query)
{
  if (!$query || $query=="" || $query===0 || is_null($query)) return "NULL";
  // Stripslashes
  if (get_magic_quotes_gpc()) $query = stripslashes($query);
  // Quote if not integer
  if (!is_numeric($query)) $query = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $query);
  return $query;
}

$dbparts = parse_url(getenv('JAWSDB_MARIA_URL'));
$db = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbparts['host'],  $dbparts['user'],  $dbparts['pass'], ltrim($dbparts['path'],'/')));

if (!$db) {
  $to = "";
  $subject = "mysql Error - DB Connection";
  $msg = "mysql DB Connection Failed:\n";
  $msq .= "\n".mysqli_errno($GLOBALS["___mysqli_ston"])."\t".mysqli_error($GLOBALS["___mysqli_ston"]);
  $headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com\r\nX-Mailer: PHP/".phpversion();
  //mail($to,$subject,$msg,$headers);
  die;
}
?>
