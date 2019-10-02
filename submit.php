<?php

include 'config.php';

$first = htmlspecialchars(trim($_POST['first']));
$last  = htmlspecialchars(trim($_POST['last']));
$email = htmlspecialchars(trim($_POST['email']));

mysql_connect($hostname,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = "INSERT INTO contacts VALUES ('$first','$last','$email')";
mysql_query($query);

mysql_close();
?>