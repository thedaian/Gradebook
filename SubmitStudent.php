<?php

$StudentID = $_POST['StudentID'];
$StudentFirst = $_POST['StudentID'];
$StudentLast = $_POST['StudentID'];
$StudentEmail = $_POST['StudentID'];

if (!$StudentID || !$StudentFirst || !$StudentLast || !$StudentEmail) {
    echo "You have not entered all the required details.<br />"
         ."Please go back and try again.";
    exit;
}

if (!get_magic_quotes_gpc()) {
    $StudentID = addslashes($StudentID);
    $StudentFirst = addslashes($StudentFirst);
    $StudentLast = addslashes($StudentLast);
    $StudentEmail = addslashes($StudentEmail);
}

@ $db = new mysqli('localhost', 'gradebook', 'root', 'deltapi0');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database";
    exit;
}

$query = "insert into students values
         ('".$StudentID."', '".$StudentFirst."', '".$StudentLast."', '".$StudentEmail."')";

$result = $db->query($query);

$db->close();


?>