<?php
 /** 
 * This file is to define the global values of your Facebook App.
 * Request the database configuration to your IT support.
 */

/** 
* Database config.
* Make sure you have the correct user permissions.
*/

/** Database name. */
define('_DB_NAME_',''); 

/** Databse username. */
define('_DB_USER_',''); 

/** Database Password. */
define('_DB_PASSWD_',''); 

/** Database Server. */
define('_DB_SERVER',''); 

/** Database Characters Codification. */
define('DB_CHARSET', 'utf8');

/**
* Facebook Config
* Get your config from your App dashboard.
* Available at https://developers.facebook.com/apps.
*/

/** Your APP ID. */
define('_APP_ID_',''); 

/** Your APP Secret Key. */
define('_APP_SECRET_',''); 

/** Your APP Workspace URL. */
define('_APP_WORKSPACE_URL_',''); 

/** Your APP Site URL. */
define('_APP_SITE_URL_',''); 

/**
* That's all! Stop editing here. 
**/

/** 
* Create the connection to the Database
*/
if (!file_exists(dirname(__FILE__).'config/database.php'))
{
    die('Database.php does not exist. Please check the \'config\' folder.'); 
else 
    require_once (dirname(__FILE__).'config/database.php');
}

/** 
* Load Facebook API 
*/
if (!file_exists(dirname(__FILE__).'config/facebook.php'))
{
    die('Facebook.php does not exist. Please check the \'config\' folder.'); 
else 
    require_once (dirname(__FILE__).'config/facebook.php');
}

?>
