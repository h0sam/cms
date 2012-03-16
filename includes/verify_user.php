<?
//session_start();
$page_name = Encrypt(curPageName());
if(!(session_is_registered("user_name")))
 {
	header("Location: index.php?page_name=".$page_name);
	exit();
 }
?>