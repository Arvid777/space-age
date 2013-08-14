<?php 
 include('core/init.inc.php'); 
//echo $_GET['action'];

$action = $_GET['action'];
$params = explode("/",$action);

switch ($params[0]) {
	case "ajax":
		include ("ajax.php");
	break;

	case "logout":
		unset ($_SESSION['auth']);
		setcookie(session_name(),session_id(), time()-60*60*24*365, '/'); 
	
		Header("Location: /");
		echo "Перенаправление <a href='/'>на главную страницу</a>";
	break;

	case "info":
		include("design/header.php");
echo "<h1>Подробная информация</h1>";
		include("design/footer.php");
	break;
	
	case "panel":
		include("design/panel.php");
	break;

	default:
		include("design/404.php");
		die();
	break;
}
