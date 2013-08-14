<?php


$dbhost = 'localhost';

$dbname = 'ta3373_galaxy';

$dbuser = 'ta3373_user';

$dbpass = 'oLQR1y0K';

$dbpref = 'glx_';

define('PRFX',$dbpref);

$DB = new PDO('mysql:dbname='.$dbname.';host='.$dbhost.';charset=UTF-8',$dbuser,$dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')) or die('Mysql error');

