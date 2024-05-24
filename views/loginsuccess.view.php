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
	
	<!-- *** Login Box *** -->
	<div class="login">
		
		<!-- Platzhalter für obere Message -->
		<div class="hoch2">&#160;</div>
		<!-- kurze msg anzeige, nach 3 Sekunden ausblenden -->
		<div id="msgDiv" class="msgAnzeige boxShadow">
			<p id="msgText"></p>
		</div>
		<div class="hoch2">&#160;</div>
				
	<div class="loginBox">
	<div class="loginKop">
	<?php
		if(!empty($userData)){ echo' Login erfolgreich: &#160;&#160;<b>'.$userData->email.'</b>';  }
		else { echo'Login nicht erfolgreich'; }
	?>
	</div>
	<div class="loginBody">
		
		<!-- ********************************************** Ausgabe *********************************** -->
		<?php
		if(!empty($userData)){
			echo'<div id="myData" class="warnText">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<caption><h3 class="navy">Deine Pers&#246;nlichen Daten bei Gott Jesus</h3></caption>
				<tr>
					<td class="widthSuccess">Token</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess" >'.$userData->token.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Datum</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.substr($userData->datum, 0, -3).'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Cookie</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->cookie.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Name</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->name.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Vorname</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->vorname.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Pseudonym</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->pseudonym.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">E-Mail</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->email.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Telefon</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->telefon.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Sprache</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->language.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Role</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->role.'</td>
				</tr>
				<tr>
					<td class="widthSuccess">Anderes</td>
					<td class="leerSuccess"><span>.................................................</span></td>
					<td class="widthSuccess">'.$userData->other.'</td>
				</tr>
				</table>
				</div>';
				
				//<!-- success Menü unten -->
				echo'<div>&#160;</div>
				<table id="" width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<a href="javascript:void(0)"  onClick="datenCopy()">Kopieren</a>
						</td>
						<td>
							<a id="mydownload" href="javascript:void(0)" onClick="datenDownload()" >Download</a>
						</td>
						<td align="center">
							<a href="javascript:void(0)"  onClick="datenDrucken()">Dr&#252;cken</a>
						</td>
						<td align="right">
							<a href="people" onClick="'.Session::sessionDestroy().'" >Weiter</a>
						</td>
					</tr>
				</table>';
				
			} else {
				
				echo'<div class="allFehler"> Es sind keine Daten vorhanden </div>';
			}
		?>
		<!-- ********************************************** Ende Ausgabe ******************************* -->
				
	</div> <!-- ende class loginBody -->		
		</div>
		</div> <!-- Ende class login -->
		
		<!-- *** Ende LoginBox *** -->	
			
			<div class="hoch4">&#160;</div><!-- placeholder für footer -->
			
		</div><!-- Ende container -->
		
		<!-- footer -->
		<div class="footerInclude">
			<?php include'footer.php'; ?>
		</div>
		
		<script type="text/javascript" src="<?php echo URL ?>public/js/liveUhr.js"></script>		
		</body>
	</html>  