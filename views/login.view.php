<!DOCTYPE html>
<html>
	<head>
		<?php include'head.view.php'; ?>	
	</head>
	
	<body class="gotigBackground">
		
	<div class="container">
		
	<!-- header -->	
	<div class="headerInclude">
		<?php include'loginheader.php'; ?>
	</div>
	
	<!-- ***************** Login Box ************** -->
	<div class="login">
		<!-- Platzhalter für obere Message -->
		<div class="hoch5">&#160;</div>
		
	<div class="loginBox">
	<div class="loginKop">Anmeldung</div>
	<div class="loginBody">
				
	<!-- Login Sperre -->
	<?php if( isset($_SESSION['sperreCount']) && $_SESSION['sperreCount'] > 10 ) : ?>
		
		<!-- Sperre für 24 Stunden Starten -->
		<?php Session::sperreDestroy(); ?>
			
		<style>
			.formSperre	{display: none; }
		</style>	
	<div class="loginSperre">
		<h3 aling="center">Account blockiert. </h3>
		<p>&#160;</p>
		<p>
			Aufgrund wiederholter Fehlversuche oder anderer ungewöhnlicher Aktivitäten ist
			das Anmelden Dienst vorübergehend gesperrt.<br>
			Bitte versuche es später noch einmal.
		</p>
		<p>&#160;</p>
	</div>
	<p>&#160;</p>
	<?php endif; ?>		
		
	
	<!-- Fehler anzeigen -->
	<div class="hoch5">
	<?php if(!empty($fehlers) ) :?>
	<div class="allFehler">
		<?= implode("<br>", $fehlers)?>
	</div>
	<?php endif; ?>
	</div>
	
			
		<!-- Login Form -->
	<form class="formSperre" name="form" method="POST">	
		<div class="loginGroup">
			<!-- <label class="loginLab loginPading">E-Mail</label> -->
			<div class="loginInput">
				<input id="" type="text" class="inputFeld" minlength="5" maxlength="256"  name="telemail" required="required"  autofocus
				onkeyup="this.value = this.value.toLowerCase()" placeholder="meine@mail.de oder +491520" >
			</div>
		</div>
	</form>
	
	<div class="hoch2">&#160;</div>
	<div>
		<a href="login" class="crimson">Abbrechen</a>
	</div>	
		
	</div> <!-- ende class loginBody -->		
	</div>
	</div> <!-- Ende class login -->
	
	<!-- *************** Ende LoginBox ******************* -->	
		
		<div class="hoch4">&#160;</div><!-- placeholder für footer -->
		
	</div><!-- Ende container -->
	
	<!-- footer -->
	<div class="footerInclude">
		<?php include'footer.php'; ?>
	</div>
	
	<script type="text/javascript" src="<?php echo URL ?>public/js/liveUhr.js"></script>		
	</body>
</html>

