<?

/* Просто печатаем массив в <pre> */
function print_array($ar) {
echo "<pre>";
print_r($ar);
echo "</pre>";
return true;
}


/* Проверяем, авторизован ли юзер */

function user_authorized() {

  return (isset($_SESSION['id']) && intval($_SESSION['id']) > 0);

}

/* генерация хэша */
function myhash($password) 
{ 
$unique_salt = substr(sha1(mt_rand()),0,22); 
return crypt($password, '$2a$10$'.$unique_salt);
}

/* Проверка пароля на соответствие хэшу */
function check_password($hash, $password) {
$full_salt = substr($hash, 0, 29);
$new_hash = crypt($password, $full_salt); 
return ($hash == $new_hash); }


