<?php
$page_start=0;

include_once 'Database.php';
include_once 'Page.php';

$tableHTML[3]=Array('students'=>'', 'classes'=>'', 'assignments'=>'');
$tableHTML['students']='<tr><td>[stud_id]</td><td>[first_name] [last_name]</td><td>[email]</td><td><a href="[url]Students/Edit/[stud_id]" rel="facebox">Edit</a></td></tr>';
$tableHTML['classes']='<tr><td>[section_id] [subject]</td><td>[class_start]</td><td>[class_end]</td><td>[class_name]</td><td>[description]</td><td><a href="[url]Classes/Edit/[class_id]" rel="facebox">Edit</a></td></tr>';
$tableHTML['assignments']='<tr><td>[class_name]</td><td>[name]</td><td>[points]</td><td>[weight]</td><td><a href="[url]Assignments/Edit/[assignment_id]" rel="facebox">Edit</a></td></tr>';

function generate_results_table($PAGE)
{
	global $db, $tableHTML;
	$page=new Page();
	//edit $tableHTML to make changes to the table rows
	switch($PAGE)
	{
		case 'students':
			$query=$db->query("SELECT * FROM students");
			$table=$page->generate_table($query, $tableHTML[$PAGE]);
			break;
		case 'classes':
			$query=$db->query("SELECT classes.*, subjects.subject FROM classes JOIN subjects ON subjects.id=classes.subject_id");

			$table=$page->generate_table($query, $tableHTML[$PAGE]);
			break;
		case 'assignments':
			$query=$db->query("SELECT assignments.*, classes.class_name FROM assignments JOIN classes ON assignments.class_id=classes.class_id ORDER BY assignment_id DESC");

			$table=$page->generate_table($query, $tableHTML[$PAGE]);
			break;
		default:
			$table="ERROR: No action specified.";
			break;
	}
	return $table;
}

function get_last_submission($PAGE)
{
	global $db, $tableHTML;
	$page=new Page();
	$row=$tableHTML[$PAGE];
	//edit $tableHTML to make changes to the table rows
	switch($PAGE)
	{
		case 'students':
			$query=$db->query("SELECT * FROM students ORDER BY stud_id DESC LIMIT 1");
			
			$page->replace_tags($db->get_row($query), $row);
			break;
		case 'classes':
			$query=$db->query("SELECT classes.*, subjects.subject FROM classes JOIN subjects ON subjects.id=classes.subject_id ORDER BY class_id DESC LIMIT 1");

			$page->replace_tags($db->get_row($query), $row);
			break;
		case 'assignments':
			$query=$db->query("SELECT assignments.*, classes.class_name FROM assignments JOIN classes ON assignments.class_id=classes.class_id ORDER BY assignment_id DESC LIMIT 1");
			
			$page->replace_tags($db->get_row($query), $row);
			break;
		default:
			$table="ERROR: No action specified.";
			break;
	}
	return $row;
}

if(isset($_REQUEST['call']))
{
	$db=new Database();
	switch($_REQUEST['call'])
	{
		case 'table':
			echo generate_results_table($_REQUEST['page']);
			break;
		case 'row':
			echo get_last_submission($_REQUEST['page']);
			break;
		default:
			echo 'ERROR: AJAX CALL FAILED';
			break;
	}
}
?>