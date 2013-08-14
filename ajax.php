<?php

switch ($params[1]) {



	case 'login':

		global $DB;

		$errors = array();
		$out = array();

		if (isset($_POST['username'])) {
			$login = strtolower($_POST['username']);
		} else $errors[] = "username";

		if (isset($_POST['password'])) {
			$password = $_POST['password'];
		} else $errors[] = "password";

		if (sizeof($errors)) {
			$out['result'] = 'error';
			$out['errors'] = $errors;
		} else {

			$request = $DB->query ("SELECT `id`,`login`,`hash` FROM ".PRFX."users WHERE login = '{$login}' LIMIT 1");
			$ar = $request->fetch();

			if (is_array($ar) && isset($ar['hash']) && check_password($ar['hash'],$password)) {

			$out['result'] = 'ok';
			
				$_SESSION['auth'] = array('id' => intval($ar['id']));
				
				if (isset($_POST['remember-me']) && intval($_POST['remember-me'])) {
					setcookie(session_name(),session_id(), time()+60*60*24*365, '/'); 
				}

			
			}
			
			else { $out['result'] = 'error'; $out['errors'] = array('authorization'); }
		}

		header('Content-type: application/json');
		echo json_encode($out);
		exit();


		

	break;

	

	case 'requestinvite':

		global $DB;
		
		$login = @$_POST['login'];
		$email = @$_POST['email'];
		
		if (!(empty($login)) && !(empty($email))) {

		$sth = $DB->prepare('INSERT INTO `'.PRFX.'requests` (`id`, `email`, `login`, `date`) VALUES (NULL, :email, :login, :date)');
		$sth->bindParam(':date', time(), PDO::PARAM_INT);
		$sth->bindParam(':email', $email, PDO::PARAM_STR, 50);
		$sth->bindParam(':login', $login, PDO::PARAM_STR, 50);
		$sth->execute();
		
		$out['result'] = 'ok';
		
		} else {
			
			$out['result'] = 'error';
			$out['error_msg'] = 'Необходимо заполнить все поля';
		
		}
		
		header('Content-type: application/json');
		echo json_encode($out);
		exit();

	break;


	case 'delciv':
	
		$out['result'] = 'ok';
		
		header('Content-type: application/json');
		echo json_encode($out);
		exit();


	break;

	default:

		include("design/404.php");
		die();

	break;


}



?>
