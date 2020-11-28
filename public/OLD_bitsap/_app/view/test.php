<?php

/*
function get_content($file, $data)
{
   $template = file_get_contents($file);

   foreach($data as $key => $value)
   {
     $template = str_replace('{'.$key.'}', $value, $template);
   }

   return $template;
}

$file = '/path/to/your/file.php';
$data = = array('var1' => 'value',
                'txt' => 'text');

echo get_content($file, $data);


ob_start();
require "signup.php";
$t = ob_get_clean();
echo $t;

/*
$t = file_get_contents("signup.php");
$t = str_replace('<?php','', $t);
$t = str_replace('?>','', $t);

eval($t);*/


?>