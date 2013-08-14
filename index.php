<? include('core/init.inc.php'); 
if (isset($_SESSION['auth']) && intval($_SESSION['auth']['id']) > 0) Header("Location: /panel");
?>
<? include ("design/header.php"); ?>

<div class="hero-unit">
  <h1>Space Age</h1>
  <br>
  <p></p>
  <p>Space Age - это глобальная онлайн-стратегия с элементами симулятора бога, работающая в режиме реального времени. Под управление игрока попадает целая планета, населённая существами, внешний облик и свойства которых он создает сам.</p>

<p>На начало игры цивилизации находятся в первобытной эпохе, но постепенно развиваются. На планете существуют множество государств, которые воюют или дружат друг с другом по разным причинам, частично зависящим от игрока. Он может ограниченно влиять на религиозные взгляды своих существ, к примеру посылая метеориты или устраивая природные катаклизмы. Так же только от выбора игрока зависит, какую из многих сотен технологических веток будет осваивать его планета. Все государства будут стремиться объединить планету под своим государственным строем и религией. Исследуя опасные технологии вроде атомного и биологического оружия игрок может ускорить процесс вооруженного объединения, или спровоцировать полную гибель цивилизации.</p>

<p>И вот, наступит день, когда взревут двигатели, и первое существо этого биологического вида оторвётся от матери-планеты и выйдет в космос. Начнётся Космическая Эра, Space Age. Колонизация планет, поиск инопланетных рас, удивительные открытия и волнующие возможности. Как будет развиваться цивилизация дальше? Продолжат ли существа исповедовать религию, созданную игроком, или отрекутся от неё? Какие цели они будут преследовать в покорении космоса - развитие или тотальное уничтожение? И это только начало. Spase Age – стратегия, выводящая понятие реалистичности и проработанности мира на новый уровень!</p>
  <br>
  <p>
    <a class="btn btn-primary btn-large" href="/" id="run">
      Узнать больше!
    </a>
	<a data-toggle="modal" class="btn btn-success btn-large" href="#betaModal" id="request_invite">
      Записаться на альфа-тестирование!
    </a>
   <!-- <a class="btn btn-danger btn-large pull-right" href="#" id="close_info">
      Закрыть
    </a> -->
  </p>
</div>

</div>

<script>
// Скрипты главной
/*
$(function () {
    $('#close_info').click(function() {
        $('.hero-unit').hide();

        setCookie('info_closed',1,{"expires":new Date().setDate( new Date().getDate() + 30 ),"path":"/"});

        return false;
    });
});
*/

$(function() {
	$('#forminvite').submit(function() {
		$('#invite-alert-error').slideUp();
		$('#invite-alert-success').slideUp();
		$.post($(this).attr("action"),$(this).serialize(),function(data) {
			if(data.result == "ok") {
					$('#invite-alert-success').slideDown();
			} else {
					$('#invite-error-text').html(result.error_msg);
					$('#invite-alert-error').slideDown();
			}
		});
		
		return false;
	});
});

</script>










<div id="betaModal" class="modal hide fade">
    <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Подать заявку на альфа-тестирование</h3>
    </div>
<div class="modal-body">
    <div class="row-fluid">
        <div class="span12">
         <!--   <div class="span6">
            <div class="logowrapper">
                <img class="logoicon" src="/design/img/satellite.png" alt="Space Age"/>
            </div>
            </div> -->
            <div class="span12" style="text-align: center;">
				<div class="alert alert-error" id="invite-alert-error" style="display:none"->
					<a class="close">×</a>
					<strong>Ошибка</strong> <span id="invite-error-text">Неизвестная ошибка.</span>
				</div>
				<div class="alert alert-success" id="invite-alert-success" style="display:none"->
					<a class="close">×</a>
					<strong>Успех</strong> Вы зарегистрировались на закрытый бета-тест. Ждите приглашения.
				</div>
                <form id="forminvite" class="form-horizontal" action="/ajax/requestinvite" method="POST">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input style="margin-bottom: 15px;" type="text" required placeholder="Логин" id="username" name="login">
                    </div>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <input style="margin-bottom: 15px;" type="email" required placeholder="Email" id="email" name="email">
                    </div>
                    <button type="submit" class="btn btn-large btn-primary btn-block">Подать заявку</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="modal-footer">
        <p><i>Space Age находится в стадии закрытого альфа-тестирования.</i></p>
    </div>
</div>


<? include ("design/footer.php"); ?>
