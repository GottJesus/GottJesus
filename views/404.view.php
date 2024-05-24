<!DOCTYPE html>
<html>
	<head>
		<?php include'head.view.php'; ?>
	</head>
	<body>
	<div class="errors">
		<div class="row">
		<div>
			<img src="<?=URL?>public/img/jesus1400.svg" width="70">
			<span class="errorsText">ERROR 404</span>
		</div>
		<div>&#160;</div>
		</div>
		<br></br>
		<p>Die angeforderte URL &#160;<b class="facblue">{ <?php echo $_GET['url']; ?> }</b>&#160; wurde auf diesem Server nicht gefunden.</p>
		<br><br>
		<p>Zurück zur vorherigen Seite: <a href="javascript:history.back()">Zurück</a></p>
		<p>Weiter zur: <a href="<?=URL?>login">Startseite</a></p>
		
	</div>	
	</body>
</html>