<?php
include_once 'Model.php';

class Edit extends Model
{
	function __construct($PAGE)
	{
		$this->page = new Page();
		$this->page->loadHeaders();
		$PAGE=strtolower($PAGE);
		$this->page->page=$this->page->load_page($PAGE.'Form');
		
		$this->tags['PAGE']=$PAGE;
	}
	
	function process_actions()
	{
		$this->tags['EDIT_DIV']='';
		$this->edit();
	}
	
	function output_page()
	{
		$this->page->replace_tags($this->tags, $this->page->page);

		//output page
		$this->page->output_page();
	}
	
	function edit()
	{
		global $db;
		$this->tags['EDIT_DIV']='';
		$id=make_safe($_REQUEST['id']);
		switch($this->tags['PAGE'])
		{
			case 'students':
				$query=$db->query("SELECT * FROM students WHERE stud_id=?", $id);
				$result=$db->get_row($query);
				$this->page->replace_tags($result, $this->page->page);
				break;
			case 'classes':
				$query=$db->query("SELECT classes.*, subjects.subject FROM classes JOIN subjects ON subjects.id=classes.subject_id WHERE classes.class_id=?", $id);
				$result=$db->get_row($query);
				$this->page->replace_tags($result, $this->page->page);
				
				$query=$db->query("SELECT * FROM subjects");
				$HTML='<option value="[id]">[subject]</option>';
				$this->tags['classSubject']=$this->page->generate_table($query, $HTML);
				break;
			case 'assignments':
				$query=$db->query("SELECT assignments.*, classes.class_name FROM assignments JOIN classes ON assignments.class_id=classes.class_id WHERE assignments.assignment_id=?", $id);
				$result=$db->get_row($query);
				$this->page->replace_tags($result, $this->page->page);
				break;
			default:
				//$this->error("No action specified.");
				break;
		}
		$this->tags['form_action']='edit';
		$this->tags['form_action_title']='Edit';
	}

}
?>