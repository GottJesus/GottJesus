(function uhrzeit(){
	
  var jetzt = new Date(),
	   T = jetzt.getDate(),
	   W = jetzt.getMonth()+1,
	   Y = jetzt.getFullYear();
	   //Y = jetzt.getFullYear().toString().substr(2,2);
  var h = jetzt.getHours(),
	   m = jetzt.getMinutes(),
	   s = jetzt.getSeconds();
   T = (T < 10 ? '0' : '') + T;
   W = (W < 10 ? '0' : '') + W;
   m = (m < 10 ? '0' : '') + m;
   s = (s < 10 ? '0' : '') + s;
   
   document.getElementById('liveuhr').innerHTML = T +'.'+ W +'.'+ Y + ' ' + h + ':' + m + ':' + s;
   setTimeout(uhrzeit, 1000);

}) ();