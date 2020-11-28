<?php


class Router
{
	private $uri;
	private $processed_uri;
	private $data;
	private $root_dir_name;
	private $route_not_available;
	
	function __construct($arg, $app_data)
	{
		//Initialize Private Variables
		$this->root_dir_name = root_dir_name;
		$this->data = $app_data;
		$this->route_not_available = $arg;

		//Codes to clean uri
		$this->uri = rtrim($_SERVER['REQUEST_URI'], '/');
		$this->uri = str_replace("?",':',$this->uri);

		if(isset($this->root_dir_name))
		{
			if($this->root_dir_name != '')
			{
				$this->uri = str_replace("/".$this->root_dir_name,'',$this->uri);
			}
		}


		//Codes to Process Request Data

		if($l = strpos($this->uri,"%"))
		{
			$m = strpos($this->uri,"bit");
			$s = substr($this->uri,$l,$m-$l+3);
			$this->uri = str_replace($s,'',$this->uri);
		}

		if($n = strrpos($this->uri,':'))
		{
			$this->processed_uri = substr($this->uri,0,$n);
			$this->processed_uri = rtrim($this->processed_uri, '/');
		    $s = explode('&', substr($this->uri,$n+1));

		    foreach($s as $k=>$v)
		    {
		        $t = explode('=',$v);
		        @$this->data->{$t[0]} = $t[1];
		    }
		}
		else
		{
			$this->processed_uri = $this->uri;
		}
	    
	}

	public function get($uri,$callback)
	{
		if ($this->processed_uri == $uri && $_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$callback($this->data, new View());
			$this->route_not_available = false;
		}
		else
			return ;
	}

	public function post($uri,$callback)
	{
		if ($this->processed_uri == $uri && $_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$callback($this->data, new View());
			$this->route_not_available = false;
		}
		else
			return ;
	}

	public function end_check($callback)
	{
		if ($this->route_not_available)
		{
			$callback(new View());
		}
	}
}


class Data {}

?>