window.addEventListener("load",function(){
	var cookie = readCookie("style");
  var title = cookie ? cookie : getPreferredStyleSheet();
  setActiveStyleSheet(title);
	styles = document.getElementsByTagName("link");

			for(var i =0; i<styles.length;i++){
				a = document.createElement("a");
				a.className="stylee";
				name=styles[i].getAttribute("title");
				a.innerHTML+=name;
				a.addEventListener("click", function(){
					console.log(this.innerHTML)
					setActiveStyleSheet(this.innerHTML);
				})
				document.getElementById("stylee").appendChild(a);
			}

	s = document.getElementById("style");
	s.addEventListener("click", function(){
		//console.log("aaaaaaa", s.className);
		if(s.className=="unclicked"){
			s.innerHTML="hide styles";
			s.className="clicked";
			a= document.getElementsByClassName("stylee");
			for(i=0; i<a.length;i++){
				a[i].style="display:block;"
			}
			document.getElementById("stylee").className="clicked";
		}else{
			s.innerHTML="show styles";
			s.className="unclicked";
			a= document.getElementsByClassName("stylee");
			for(i=0; i<a.length;i++){
				a[i].style="display:none;"
			}
			document.getElementById("stylee").className="unclicked";
		}
	})


});


function setActiveStyleSheet(title) {
   var i, a, main;
   for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
     if(a.getAttribute("rel").indexOf("style") != -1
        && a.getAttribute("title")) {
       a.disabled = true;
       if(a.getAttribute("title") == title){ a.disabled = false;
       	document.cookie = "style="+title;
       }
     }
   }
};

function getPreferredStyleSheet() {
  var i, a;
  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
    if(a.getAttribute("rel").indexOf("style") != -1
       && a.getAttribute("rel").indexOf("alt") == -1
       && a.getAttribute("title")
       ) return a.getAttribute("title");
  }
  return null;
}
function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
