<?php
echo'<title>';
	if(isset($this->title)){ echo $this->title; } else{ echo'Gott Jesus'; }
echo'</title>';


echo'<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/x-icon" href="'.URL.'public/img/jesu64.ico"  />
<style type="text/css"><!-- @import"'.URL.'public/css/style.css"; --></style>
<script type="text/javascript" src="'.URL.'public/js/functions.js"></script>
<script type="text/javascript" src="'.URL.'public/js/cookie.js"></script>';

if(isset($this->js))
{
		
	foreach($this->js as $js)
	{
		// einfach in 'controllers/login' einbinden...und in function... 	public function index(){ $this->js = array('public/js/login.js'); }
		echo'<script type="text/javascript" src="'.URL.$js.'"></script>';
	}
}
		
?>