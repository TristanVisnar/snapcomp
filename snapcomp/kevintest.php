<?php
echo 'php dela';

if(function_exists('mysql_connect'))
{
	echo 'MYSQL JE INSTALAN <br>';
}
else
{
	 echo 'MYSL NI <br>';
}

if(function_exists('mysqli_connect'))
{
	echo 'MYSQLI JE INSTALAN <br>';
}
else
{
	 echo 'MYSLI NI <br>';
}

if(function_exists('mysqli_get_client_state'))
{
	echo 'MYSQLND JE ENABLAN <br>';
}
else
{
	echo 'UPORABLJA SE LIBMYSQLCLIENT DRIVER';
}
var_dump(phpinfo());
?>
