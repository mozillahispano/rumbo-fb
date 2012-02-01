<?
/**** BEGIN DATABASE CONNECTION ****/
class Conectar 
{
	public static function con()
	{
		
		$con=mysql_connect(_DB_SERVER,_DB_USER_,_DB_PASSWD_);
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db(_DB_NAME_);	
		return $con;
	}
	
}
/**** END DATABASE CONNECTION ****/
?>
