<?php
class View
{
	private $view_path;
	private $logic_path;
	
	function __construct()
	{
		$rdn = (root_dir_name != '')?'/'.root_dir_name:'';
		$this->view_path =  $_SERVER['DOCUMENT_ROOT'].$rdn."/_app/view/";
		$this->logic_path = $_SERVER['DOCUMENT_ROOT'].$rdn."/_app/logic/";
	}

	public function view($template,$res = '')
	{
		if($template != '')
		{
			$render = $this->view_path.$template;
			include("$render");
		}
	}

	public function logic($template)
	{
		if($template != '')
		{
			$render = $this->logic_path.$template;
			include("$render");
		}
	}
}
?>