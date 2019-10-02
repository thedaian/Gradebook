<?php
include 'Backend.php';
include 'Edit.php';

class Gradebook
{
	var $tags = array();
	
	function __construct()
	{
		global $db;
		$db = new Database();
	}
	
	function make_page()
	{
		if(!empty($_REQUEST['page']))
		{
			$PAGE=make_safe($_REQUEST['page']);
		} else {
			$PAGE='Overview';
		}
		
		if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
		{
			$current_page=new Edit($PAGE);
			$current_page->process_actions();
			$current_page->output_page();
		} else {
			$current_page=new Backend($PAGE);
			$current_page->process_actions();
			$current_page->output_page();
		}
	}
	
	function error($string=NULL)
	{
		echo $string;
		die();
	}
	
/*	function __destruct()
	{
	
	}*/
}
?>