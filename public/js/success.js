"use strict";
/**
 *	Den 14.05.2024
 */
 

/**
 *  Registrier Daten in Zwieschenanlage speichern 
 */
function datenCopy() {
     
     var copydiv = document.getElementById('myData');
     navigator.clipboard.writeText(copydiv.innerText);
     
    msgShow("Somit ist der Text in der Zwischenablage gespeichert.");
 }
 
 
 /**
  * Download meine alle gespeicherte Daten
  */
 function datenDownload() {
     
     // Daten holen + Link erstellen
     var myDaten = document.getElementById('myData').innerText;
     var link = document.getElementById('mydownload');
     if (link.href) {
         URL.revokeObjectURL(link.href);
       }
       
     // BLOB object erstellen  
     var blob = new Blob([myDaten], {type: "text/plain"});
     var txtname = "myname.txt";
     
     // Alles auf den Link schmeißen    
     link.href = URL.createObjectURL(blob);
     link.download = txtname;
     link.textContent = "Herunterladen";
     link.style = "pointer-events: none; color: red";
     
     msgShow("Heruntergeladene Dateien sind im Ordner Downloads gespeichert");
          
 }
 
 
 /**
  * Drücken meine alle gespeicherte Daten
  */
  function datenDrucken() {
      
      window.print();
      
      msgShow("Daten sind bereit zum Dr&#252;cken");
  }

 

 