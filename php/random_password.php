<?php
$pattern = "!@#$%^&*()_+=-/.,';]\[?><:{}~qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
$length = strlen($pattern)-1;

$i;
$password = [];
for($i=0;$i<8;$i++)
{
	$indexing_num = rand(0,$length);
	$password[] = $pattern[$indexing_num];
}
echo implode($password);

?>