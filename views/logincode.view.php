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
	<div class="loginKop">Mail Register &#160;&#160;<b><?=$logindata?></b>
		&#160;&#160;<?=$_SESSION['loginDaten']['userscode']?>&#160;<small>in logincode Zeile: 23</small>
	</div>
	<div class="loginBody">
		
	<!-- Login Code Sperre -->
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
	<?php if(!empty($fehlers) ) :?>
	<div class="allFehler">
		<?= implode("<br>", $fehlers)?>
	</div>
	<p class="hoch1"></p>
	<?php endif; ?>

	
	<!-- Nachricht anzeigen -->
	<p class="warnText formSperre">
			Vielen Dank, bitte überprüfen Sie Ihr Email-Postfach!<br>
			Wir haben Ihnen eine Bestätigungsmail an die von Ihnen angegebene Email-Adresse gesendet.
			Bitte prüfen Sie auch Ihren SPAM-Ordner, falls Sie in den nächsten Minuten keine Bestätigung Code erhalten haben!
			<br>
			Vielen Dank und mit freundlichen Grüßen!
			<br>
			Ihr Messias Team
	</p>
	<div>&#160;</div>
	
			
		<!-- Login Name -->
	<form class="formSperre" name="form" method="POST">	
		<div class="loginCodeBox">
			<!-- <label class="loginLab loginPading">E-Mail</label> -->
			<div class="loginCode" >
				<input id="CODE1" type="text" class="inputAll inputCode" name="codeEins" minlength="1" maxlength="1"  required autofocus
				onkeyup="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length == 1){ document.getElementById('CODE2').focus();}" >
			</div>
			
			<div class="loginCode">	
				<input id="CODE2" type="text" class="inputAll inputCode" name="codeZwei" minlength="1" maxlength="1" placeholder="-"  required 
				onkeyup="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length == 1){ document.getElementById('CODE3').focus();}" >
			</div>
			
			<div class="loginCode">	
				<input id="CODE3" type="text" class="inputAll inputCode" name="codeDrei" minlength="1" maxlength="1" placeholder="-" required
				onkeyup="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length == 1){ document.getElementById('CODE4').focus();}" >
			</div>
			
			<div class="loginCode">	
				<input id="CODE4" type="text" class="inputAll inputCode" name="codeVier" minlength="1" maxlength="1" placeholder="-" required
				onkeyup="this.value=this.value.replace(/[^0-9]/g,''); if(this.value.length == 1){ document.getElementById('BUTCODE').focus();}" >
			</div>
			
		</div><!-- ende loginCodeBox -->
		
		<div class="hoch2">&#160;</div>
		<div class="loginButtonBox">
			<button id="BUTCODE" name="codeButton" type="hidden" class="loginCodeButton buttonAll buttonBlau">Einloggen</button>
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

