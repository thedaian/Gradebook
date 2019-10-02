<?php
class Model
{
	protected $tags = array();
	protected $page;
	
	function __construct($PAGE)
	{
		$this->page = new Page();
		$this->page->loadHeaders();
		$this->page->page=$this->page->load_page($PAGE);
		
		$this->tags['PAGE']=strtolower($PAGE);
	}
	
	function error($string=NULL)
	{
		echo $string;
		die();
	}
	
	function output_page()
	{
		$this->page->replace_tags($this->tags, $this->page->html_header);
		$this->page->replace_tags($this->tags, $this->page->page);
		$this->page->generate_menu($this->tags['PAGE']);

		//output page
		$this->page->output_page();
	}	
}
?>