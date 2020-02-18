<?php
function strip_to_num($str)
{
  if(strlen($str)>0)
  {
    if(is_numeric($str[0])) return $str[0] . strip_to_num(substr($str,1));
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

$db = pg_connect(getenv('DATABASE_URL'));

if (!$db) {
  $to = "";
  $subject = "Error - DB Connection";
  $msg = "DB Connection Failed:\n";
  $headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com\r\nX-Mailer: PHP/".phpversion();
  //mail($to,$subject,$msg,$headers);
  die;
}
?>
