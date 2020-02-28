<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Projekt PHP</title>
    <meta http-equiv="Content-Type"
          content="application/xhtml+xml; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="en"/>
    <link rel="stylesheet" title="mainStyle" type="text/css" href="./style.css"/>
    <link rel="alternate stylesheet" title="marvelousStyle" type="text/css" href="./style2.css"/>
     <link rel="alternate stylesheet" title="tgStyle" type="text/css" href="./style3.css"/>
      <script src="./js/style.js"></script>

</head>
<body>
  <div id="komunikator" >
    <label><input type="checkbox" name="turn" id="turn" value="on"/>Włącz komunikator </label>
    <div class="panel" style="display:none;">
    <div id="messages">

    </div>
     <input type="text" name="mess" id="mess"/>
      <input type="text" name="nick" id="nick" placeholder="nick"/>
    <button id="send">send</button>
  </div>
  </div>
  <script type="text/javascript">
    var i=0;
    function poll(gets="") {
      var ajax = new XMLHttpRequest();
      ajax.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

          if (this.status === 200) {
            try {

              var json = JSON.parse(this.responseText);

            } catch {
              return;
            }
            if (json.status !== true) {

              alert(json.error);return;
            }
             console.log('poll');
            var div = document.getElementById("messages");
           
            div.removeChild(div.firstChild);
            
            var p = document.createElement("p");
            p.innerHTML=json.content;
            console.log(json.content);
            div.appendChild(p);
            //poll();
          } else {
            //poll();
             console.log('poll');
          }

        }
      }
      ajax.open('GET', 'komunikator.php'+gets, true);
      ajax.send();
    
  }
  
  x=document.getElementById("turn");
  x.addEventListener("change", function(){
    panel = document.getElementsByClassName("panel")[0];
    if(x.checked){
      console.log(i)
      panel.style="display:block;";
      if(i==0){
       document.cookie='lastUpdate=0';
      }
       int =  setInterval(function(){poll()}, 10)
      i++;
      
    }else{
      i=0;
      panel.style="display:none;";
      clearInterval(int);
    }

  })
  s = document.getElementById("send");
  s.addEventListener("click", function(){

   var gety = "?nick="+document.getElementById("nick").value+"&mes="+document.getElementById("mess").value;
   poll(gety);
  })

  </script>

	<div id="stylee">
    <button id="style" class="unclicked">show styles</button>
	</div>
  
	<h1 style="text-align: center;
color: white;
text-shadow: 2px 2px 2px black;
font-size: 72px;
margin-top: 250px;">Projekt PHP </h1>
<div id="content">
<?php require 'nav.php';?>