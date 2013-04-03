<html>  
<head>  
<script type="text/javascript">  
// 1 detik = 1000  
window.setTimeout("waktu()",1000);    
function waktu() {     
    var tanggal = new Date();    
    setTimeout("waktu()",1000);
	var hours = tanggal.getHours();
	var minutes = tanggal.getMinutes();
	
	if(hours > 11){
	document.getElementById("output").innerHTML = "<b>"+tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds()+" PM";  
	} else {
	document.getElementById("output").innerHTML = "<b>"+tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds()+" AM";
	}  
}  
</script>  
</head>  
<body bgcolor="red" text="black" onload="waktu()">  
<?PHP
date_default_timezone_set("Asia/Jakarta");
echo "<b>".date("l, d F y")."&nbsp;";
?><div id="output"></div>
</body>  
</html> 
  