<?php
include("koneksi.php");
include("session.php");

	session_unset();
	session_destroy();
?><script language="JavaScript">alert('Anda telah logout'); 
document.location='index.php'</script>