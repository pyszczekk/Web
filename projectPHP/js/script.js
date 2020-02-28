window.addEventListener("load",function(){
path=window.location.pathname
if(path=="/projectPHP/AddPost.php"){
	fDate = document.getElementsByName("date");
	d = new Date();
	var date = fDate[0].value
	var year = date.substring(0,4)
	date = fDate[0].value
	var month = date.substring(5,7)
	var date = fDate[0].value
	var day = date.substring(8)
	fTime = document.getElementsByName("hour");
	var h,m;
	time = fTime[0].value;
	h=time.substring(0,2);

	time = fTime[0].value;
	min=time.substring(4);
	//alert(parseInt(month)+"-"+year+"-"+day);
	if(parseInt(day) == d.getDate() && parseInt(month) == (d.getMonth()+1) && year == d.getFullYear() && parseInt(h)==d.getHours() && parseInt(min)==d.getMinutes()){
		//alert("data poprawna")
	}else{
		
		months=d.getMonth();
		days=d.getDate();
		hours=d.getHours();
		minutes=d.getMinutes();
		if(d.getDate()<10){
			days = "0"+d.getDate();
		}
		if(d.getMonth()+1<10){
			months="0"+(d.getMonth()+1);
		}
		if(d.getHours()<10){
			hours = "0"+d.getHours();
		}
		if(d.getMinutes()<10){
			minutes = "0"+d.getMinutes();
		}
		fDate[0].value=d.getFullYear()+"-"+months+"-"+days;
		fTime[0].value=hours+":"+minutes;
	}
	fDate[0].addEventListener("blur", function(){
		wrongDate = false;
		if(fDate[0].value.length!=10 ){
			wrongDate=true;
		}
			da=new Date();
			fDate[0].style = "";
			var w = fDate[0].value;
			var y = parseInt(w.substring(0,4))
			w = fDate[0].value;
			var m = parseInt(w.substring(5,7))
			w = fDate[0].value;
			var d = parseInt(w.substring(8));
			w = fDate[0].value;
			if(y>2019 || y<=0 || isNaN(y)){
				wrongDate=true;
				y=da.getFullYear();
			}	
			if(m>12 || m<=0 || isNaN(m)){
				wrongDate=true;
				
			}

			if(d>31 || d<=0 || isNaN(d)){
				wrongDate=true;
				
			}
			if(w[4]!="-" && w[6]!="-"){
				fDate[0].value=y+"-"+m+"-"+d;
			}
			if(wrongDate){
				m=da.getMonth()+1;
				d=da.getDate();
				y=da.getFullYear();
				if(m<10){
					m="0"+m;
				}
				if(d<10){
					d="0"+d;
				}
				console.log(y)
				if(y<10){
					y="000"+y;
				}
				else if(y<100){
					y="00"+y;
				}
				else if(y<1000){
					y="0"+y;
				}
			fDate[0].value=y+"-"+m+"-"+d;
		}
	})
	fTime[0].addEventListener("blur", function(){
		wrongtime = false;
		if(fTime[0].value.length!=5){
			wrongtime=true;
		}
		var h = fTime[0].value[0]+fTime[0].value[1];
		var mins = fTime[0].value[3]+fTime[0].value[4];
		if(h>=24|| h<0){
			wrongtime=true;
		}
		if(mins<0 || mins>=60){
			wrongtime=true;
		}
		if(wrongtime){
			ad = new Date();
			hh=ad.getHours();
			mm=ad.getMinutes();
			if(hh<10){
				hh="0"+hh;
			}
			if(mm<10){
				mm="0"+mm
			}
			fTime[0].value=hh+":"+mm;
		}
		
	})
	file=document.getElementsByName("files[]")[0];
	file.addEventListener("change",function(){
		if(file.value!=""){
			add();
		}
	})
}
	
})
function add(){
             input = document.createElement("input");
                input.name ="files[]";
                input.type="file";
                input.addEventListener("change",add);
                document.getElementById("zal").appendChild(input);
           }

