<?php
include_once 'Model.php';
include_once 'ajaxCall.php';

class Backend extends Model
{
	private $formtags;

	function process_actions()
	{
		$this->tags['EDIT_DIV']='class="invisible"';
		if(isset($_REQUEST['action']))
		{
			switch($_REQUEST['action'])
			{
				case 'add_student':
					$this->add_student();
					break;
				case 'add_class':
					$this->add_class();
					break;
				case 'add_assignment':
					$this->add_assignment();
					break;
				case 'edit_student':
					$this->edit_student(make_safe($_POST['StudentID']));
					break;
				case 'edit_class':
					$this->edit_class(make_safe($_POST['class_id']));
					break;
				case 'edit_assignment':
					$this->edit_assignment(make_safe($_POST['assignment_id']));
					break;
				default:
					$this->error("No action specified.");
					break;
			}
		}
		
		switch($this->tags['PAGE'])
		{
			case 'students':				
				$formtags=array('stud_id'=>'', 'first_name'=>'', 'last_name'=>'', 'email'=>'');
				break;
			case 'classes':
				$formtags=array('section_id'=>'', 'class_id'=>'', 'subject_id'=>'', 'class_start'=>'', 'class_end'=>'', 'email'=>'', 'class_name'=>'', 'description'=>'');	
				
				global $db;
				$query=$db->query("SELECT * FROM subjects");
				$HTML='<option value="[id]">[subject]</option>';
				$formtags['classSubject']=$this->page->generate_table($query, $HTML);
				break;
			case 'assignments':				
				$formtags=array('assignment_id'=>'', 'name'=>'', 'points'=>'', 'weight'=>'');
				break;
			default:
				//$this->error("No action specified.");
				break;
		}
		
		if($this->tags['PAGE']!='overview')
		{
			$formtags['form_action_title']='Add';
			$formtags['form_action']='add';
			$this->tags['ADD_FORM']=$this->page->load_page($this->tags['PAGE'].'Form');
			$this->page->replace_tags($formtags, $this->tags['ADD_FORM']);
		}
		
		$this->tags['table']=generate_results_table($this->tags['PAGE']);
	}
	
	//Add functions
	function add_student()
	{
		global $db;
		$sql="INSERT INTO students VALUES('?', '?', '?', '?')";
		$db->query($sql, make_safe($_POST['StudentID']), make_safe($_POST['StudentFirst']), make_safe($_POST['StudentLast']), make_safe($_POST['StudentEmail']));
	}
	
	function add_class()
	{
		$start_time=make_safe($_POST['ClassStartTime']).":00";
		$end_time=make_safe($_POST['ClassEndTime']).":00";
		global $db;
		$sql="INSERT INTO classes VALUES('', '?', '?', '?', '?', '?', '?')";
		$db->query($sql, make_safe($_POST['ClassSection']), make_safe($_POST['ClassSubject']), $start_time, $end_time, make_safe($_POST['ClassName']), make_safe($_POST['ClassDescription']));
	}
	
	function add_assignment()
	{
		global $db;
		$sql="INSERT INTO assignments VALUES('', '?', '?', '?', '?')";
		$db->query($sql, make_safe($_POST['classID']), make_safe($_POST['AssignName']), make_safe($_POST['AssignAmt']), make_safe($_POST['AssignWeight']));
	}
	
	//edit functions	
	function edit_class($id)
	{
		if(isset($_POST['ClassSubject']) && (!empty($_POST['ClassSubject'])))
		{
			global $db;
			$start_time=make_safe($_POST['ClassStartTime']);
			$end_time=make_safe($_POST['ClassEndTime']);
			$sql="UPDATE classes SET section_id='?', subject_id='?', class_start='?', class_end='?', class_name='?', description='?' WHERE class_id='?'";
			$db->query($sql, make_safe($_POST['ClassSection']), make_safe($_POST['ClassSubject']), $start_time, $end_time, make_safe($_POST['ClassName']), make_safe($_POST['ClassDescription']), $id);
		}
	}

	function edit_student($id)
	{
		global $db;
		$sql="UPDATE students SET stud_id='?', first_name='?', last_name='?', email='?' WHERE stud_id='?'";
		$db->query($sql, make_safe($_POST['StudentID']), make_safe($_POST['StudentFirst']), make_safe($_POST['StudentLast']), make_safe($_POST['StudentEmail']), $id);
	}

	function edit_assignment($id)
	{
		if(isset($_POST['classID']) && (!empty($_POST['classID'])))
		{
			global $db;
			$sql="UPDATE assignments SET class_id='?', name='?', points='?', weight='?' WHERE assignment_id='?'";
			$db->query($sql, make_safe($_POST['classID']), make_safe($_POST['AssignName']), make_safe($_POST['AssignAmt']), make_safe($_POST['AssignWeight']), $id);
		}
	}
}
?>