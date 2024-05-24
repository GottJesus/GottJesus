	<!-- header, eine div mit den Petrus und Uhr -->
<div class="headerTab">
	<table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="70" align="center">
				<a href="<?php URL?>login">
				<img src="<?php echo URL ?>public/img/petrus.jpg" width="40" height="40" />
				</a>
			</td>
			<td align="center">
				<h3 class="navy">Gott Jesus</h3>
			</td>
				<td width="100" align="center">
				<span id="livedatum" class="navy"></span>
				<span id="liveuhr" class="leuchtblue"></span>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript" src="<?php echo URL ?>public/js/liveUhr.js"></script>