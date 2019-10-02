<?php
$page_start = microtime(TRUE);

include 'Database.php';

include 'Page.php';
include 'Gradebook.php';

$book = new Gradebook();

$book->make_page();
?>