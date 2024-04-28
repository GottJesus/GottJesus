<!DOCTYPE html>
<html>
	<head>
	<?php
	echo'<title>';
		if(isset($this->title)){ echo $this->title; } else{ echo'Verwaltung'; }
	echo'</title>';
	?>	
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" type="image/x-icon" href="<?=URL?>public/img/jesu64.ico"  />
	<!-- <link rel="stylesheet" href="<?=URL?>public/css/style.css" /> -->
	<style type="text/css"><!-- @import"<?=URL?>public/css/style.css"; --></style>
	<script type="text/javascript" src="<?=URL?>public/js/jquery@371.js"></script>
	
	<!-- login.js anbinden, gestartet in controllers/login.php(in __construct) -->
	<?php
	if(isset($this->js)){
		
		foreach($this->js as $js){
			// $this->view->js = array('login/js/default.js'); ...Anbindung von controllers/????.php/_construct()
			// Anbindung von views : src="'.URL.'views/'.$js.'"
			echo'<script type="text/javascript" src="'.URL.$js.'"></script>';
		}
	}
	
/* 	$text = "paul";
	$pass = md5($text);
	echo $pass */
	
	?>
	
	</head>
	
	<body>
	<div class="container">
	<!-- header -->	
	<div class="headerInclude">
		<?php include'header.php'; ?>
	</div>
	
	<!-- Login Box-->
	<div class="loginBox">
		<div  align="center">
			<div id="modelAusgabe"></div>
			<div id="logFehler" class="loginFehler"></div>
			<form name="formName" onSubmit="return validateForm(this.form)">
			<input name="inputName" class="loginInput" type="text" md5(value) maxlength="10" placeholder="Password" required autofocus />
			</form>
			
		</div>
	</div>
		
		
		<div class="hoch4">&#160;</div><!-- placeholder für footer -->
	</div><!-- Ende container -->
	<!-- footer -->
	<div class="footerInclude">
		<?php include'footer.php'; ?>
	</div>
	
	<script type="text/javascript" src="<?php echo URL ?>public/js/liveUhr.js"></script>		
	</body>
</html>