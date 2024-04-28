function setCookie(name, value, xday) {
    var d = new Date();
	d.setTime(d.getTime() + (xday * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = name + "=" + value + ";" + expires;

  	// cookie Richtlinien schlißen
  	var cc = document.cookie.search(name) !== -1 ? true : false;
  	if(cc == true)
  	{
  		document.getElementById('COKIE').style.display = 'none';
  	}
}