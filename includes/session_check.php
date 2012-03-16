<?
if(!isset($_SESSION["name"]) || !isset($_SESSION["pass"])){
	header("Location: login.php");
}elseif (isset($_SESSION["name"]) && isset($_SESSION["pass"])){
	$uid = $_SESSION["uid"];
}
?>