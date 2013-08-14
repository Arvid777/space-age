<? include ("design/header.php");

if (@intval($_SESSION['auth']['id']) === 0) Header("Location: /");
 ?>

<div class="container">
<div class="row">
<div class="span12">
<!--<h1>Главная панель</h1>-->

<?
/*
$STAR = new Star();

print_array($STAR);*/
/*
$f = $DB->query("SELECT * FROM ".PRFX."stars WHERE id = 46 LIMIT 1");
$ar = $f->fetch();
$data = $ar['data'];
$STAR = unserialize($data);
print_array($STAR);*/

$CR = new Primate();
print_array($CR);

?>


<?
$player_id = intval($_SESSION['auth']['id']);

$res = $DB->query("SELECT * FROM ".PRFX."users WHERE `id` = {$player_id} LIMIT 1");
$ar = $res->fetch();
$civ_id = intval($ar['civilisation']);

if ($civ_id > 0) {
?>
<p>У вас уже есть цивилизация</p>
<button onclick="$.post('/ajax/delciv',{},function () {document.location.reload() });" >Уничтожить</button>
<?
} else {
?>

<? $step = @intval($_POST['step']); ?>
<h1>Создание новой цивилизации</h1>
<form class="form-horizontal well" action="/panel?step=<?=$step+1?>" method="POST" ><input type="hidden" name="step" value="<?=$step+1?>" >
        <fieldset>
          <legend>День <?=$step+1?></legend>
<? switch ($step) {
case 0: ?>
          <div class="control-group">
            <label class="control-label" for="input01">Название цивилизации</label>
            <div class="controls">
              <input required class="input-xlarge" id="input01" name="name_all" type="text">
              <span class="help-inline">Например «люди».</span>
            </div>
          </div>
	  <div class="control-group">
            <label class="control-label" for="input02">Название существа</label>
            <div class="controls">
              <input required class="input-xlarge" id="input02" name="name_one" type="text">
              <span class="help-inline">Например «человек».</span>
            </div>
          </div>
	  <div class="control-group">
            <label class="control-label" for="input03">Название планеты</label>
            <div class="controls">
              <input required class="input-xlarge" id="input03" name="name_planet" type="text">
              <span class="help-inline">Например «Земля».</span>
            </div>
          </div>
	  <div class="control-group">
            <label class="control-label" for="input04">Название звезды</label>
            <div class="controls">
              <input required class="input-xlarge" id="input04" name="name_star" type="text">
              <span class="help-inline">Например «Солнце».</span>
            </div>
          </div>
<? break;
case 1: ?><?// print_array($_POST);

$_SESSION['new_civ'] = array();
$_SESSION['new_civ']['name_all'] = strtolower(@$_POST['name_all']);
$_SESSION['new_civ']['name_one'] = strtolower(@$_POST['name_one']);
$_SESSION['new_civ']['name_planet'] = ucfirst(@$_POST['name_planet']);
$_SESSION['new_civ']['name_star'] = ucfirst(@$_POST['name_star']);

 ?>
<div class="control-group">
            <label class="control-label" for="select01">Тип звезды «<?=$_SESSION['new_civ']['name_star']?>»</label>
            <div class="controls">
              <select id="select01" name="star_type" >
                <option value="0" >Желтый карлик</option>
                <option value="1" >Оранжевый карлик</option>
                <option value="2" >Красный карлик</option>
                <option value="3" disabled="disabled" >Белый карлик</option>
              </select>
            </div>
          </div>
<!--<div class="control-group">
            <label class="control-label" for="select01">Тип планеты «<?=$_SESSION['new_civ']['name_planet']?>»</label>
            <div class="controls">
              <select id="select01" name="planet_type" >
                <option value="0" >Континентальная</option>
                <option value="1" >Болотистая</option>
                <option value="2" >Пустынная</option>
                <option value="3" >Ледяная</option>
		<option value="4" disabled="disabled" >Океаническая</option>
              </select>
            </div>
          </div>-->
<div class="control-group">
            <label class="control-label" for="select01">Тип атмосферы</label>
            <div class="controls">
              <select id="select01" name="planet_atm" >
                <option value="1" >Азот-кислородная</option>
                <option value="2" disabled="disabled" >Углекислая</option>
                <option value="3" disabled="disabled" >Метановая</option>
                <option value="0" disabled="disabled" >Без атмосферы</option>
              </select>
            </div>
          </div>
<div class="control-group">
            <label class="control-label" for="select01">Тип существа «<?=$_SESSION['new_civ']['name_one']?>»</label>
            <div class="controls">
              <select id="select01" name="creature_type" >
                <option value="0" >Приматы</option>
                <option value="1" >Кошачьи</option>
                <option value="2" >Рептилии</option>
                <option value="3" >Птицы</option>
                <option value="4" disabled="disabled" >Водные млекопитающие</option>
                <option value="5" disabled="disabled" >Рыбы</option>
              </select>
            </div>
          </div>
<? break;
case 2:

//$_SESSION['new_civ']['planet_type'] = intval(@$_POST['planet_type']);
$_SESSION['new_civ']['planet_atm'] = intval(@$_POST['planet_atm']);
$_SESSION['new_civ']['star_type'] = intval(@$_POST['star_type']);
$_SESSION['new_civ']['creature_type'] = intval(@$_POST['creature_type']);

?>
<p><b>Цивилизация создана</b></p>
<? //print_array($_SESSION); 

$STAR = new Star($_SESSION['new_civ']['name_star'],false,$_SESSION['new_civ']['star_type']);

//print_array($STAR);
$planet_id = $STAR->addPlanet(false, $_SESSION['new_civ']['name_planet'],1,$_SESSION['new_civ']['planet_atm']);
print_array($STAR);

$str = serialize($STAR);
//print_array(unserialize($str));
$coords = $STAR->getInfo('galaxy_coords');

$sth = $DB->prepare('INSERT INTO `'.PRFX.'stars` (`id`, `data`, `coords`) VALUES (NULL, :data, :coords)');
		$sth->bindParam(':data', $str, PDO::PARAM_STR);
		$sth->bindParam(':coords', implode(",",$coords), PDO::PARAM_STR, 20);
		$sth->execute();
$star_id = $DB->lastInsertId();

?>
<a href="/panel" class="btn btn-success">Перейти к управлению</a>
<?

break;
}?>
<?/*
          <div class="control-group">
            <label class="control-label" for="optionsCheckbox">Checkbox</label>
            <div class="controls">
              <label class="checkbox">
                <input id="optionsCheckbox" value="option1" type="checkbox">
                Option one is this and that—be sure to include why it's great
              </label>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Select list</label>
            <div class="controls">
              <select id="select01">
                <option>something</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="multiSelect">Multicon-select</label>
            <div class="controls">
              <select multiple="multiple" id="multiSelect">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="fileInput">File input</label>
            <div class="controls">
              <input class="input-file" id="fileInput" type="file">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="textarea">Textarea</label>
            <div class="controls">
              <textarea class="input-xlarge" id="textarea" rows="3"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="focusedInput">Focused input</label>
            <div class="controls">
              <input class="input-xlarge focused" id="focusedInput" value="This is focused…" type="text">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Uneditable input</label>
            <div class="controls">
              <span class="input-xlarge uneditable-input">Some value here</span>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="disabledInput">Disabled input</label>
            <div class="controls">
              <input class="input-xlarge disabled" id="disabledInput" placeholder="Disabled input here…" disabled="" type="text">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="optionsCheckbox2">Disabled checkbox</label>
            <div class="controls">
              <label class="checkbox">
                <input id="optionsCheckbox2" value="option1" disabled="" type="checkbox">
                This is a disabled checkbox
              </label>
            </div>
          </div>
          <div class="control-group warning">
            <label class="control-label" for="inputWarning">Input with warning</label>
            <div class="controls">
              <input id="inputWarning" type="text">
              <span class="help-inline">Something may have gone wrong</span>
            </div>
          </div>
          <div class="control-group error">
            <label class="control-label" for="inputError">Input with error</label>
            <div class="controls">
              <input id="inputError" type="text">
              <span class="help-inline">Please correct the error</span>
            </div>
          </div>
          <div class="control-group success">
            <label class="control-label" for="inputSuccess">Input with success</label>
            <div class="controls">
              <input id="inputSuccess" type="text">
              <span class="help-inline">Woohoo!</span>
            </div>
          </div>
          <div class="control-group info">
            <label class="control-label" for="selectError">Select with info</label>
            <div class="controls">
              <select id="selectError">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
              <span class="help-inline">Woohoo!</span>
            </div>
          </div>
*/?><? if ($step < 2) {?>
          <div class="form-actions">
	    <? if ($step > 0) {?><a href="/panel<? if ($step>1) { ?>?step=<?$step-1?><?}?>" class="btn btn-warning">Назад</a><?}?>
            <button type="submit" id="next" class="btn btn-primary">Далее</button>
          </div>
<?}?>
        </fieldset>
      </form>
<?
}
?>

</div>

</div>
</div>



<? include ("design/footer.php"); ?>
