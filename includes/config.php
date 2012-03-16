<?php
/*$db_host='localhost';
$db_user='root';
$db_name='cms';
$db_password="root";

$mysql_link = mysql_connect($db_host,$db_user,$db_password)or die(mysql_error());
$db = mysql_select_db($db_name,$mysql_link)or die(mysql_error());*/

/*STEP 1: Include the project's required file, class.db.php.*/
include("../classes/class.db.php");



/*STEP 2: Connect to database using the project's constructor.*/
$db = new db("mysql:host=localhost;dbname=cms", "root", "root");

$db->setErrorCallbackFunction("myErrorHandler");


include_once "functions.php";
?>