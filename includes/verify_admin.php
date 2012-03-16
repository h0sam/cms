<?
session_start();
if(!(session_is_registered("username")))
 {
header("Location: index.php");

 }
?>