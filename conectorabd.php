<?

function connect(){
if (!($server=mysql_connect("skrik1893.startlogicmysql.com","santillanadb","G3nerico01")))

//if (!($server=mysql_connect("localhost","root","")))
	{
		echo "Fall&oacute; la conexi&oacute;n a la base de datos";
		exit();
	}
	mysql_select_db("santillana");
	return $server;
}

?>
