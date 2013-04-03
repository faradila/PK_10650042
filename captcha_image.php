<?PHP
session_start();
$random=md5(microtime());
$random=substr($random,0,5);
$NewImage =imagecreatefrompng("captcha.png");

$LineColor1=imagecolorallocate($NewImage,100,100,255);
$LineColor2=imagecolorallocate($NewImage,255,125,0);
$TextColor=imagecolorallocate($NewImage,255,100,100);

$text_x=rand(0,125);
$text_y=rand(20,75);
$line1_x1=rand(0,199);
$line1_x2=$text_x-5;
$line1_y1=rand(0,80);
$line1_y2=$text_y-5;
$font='font.ttf';
imageline($NewImage,0,0,$line1_x1,$line1_y2,$LineColor2);
imagettftext($NewImage,18,0,$text_x,$text_y,$TextColor, $font, $random);
imageline($NewImage,$line1_x1,$line1_y1,$line1_x2,$line1_y2,$LineColor1);
imageline($NewImage,$line1_x1,$line1_y1,200,0,$LineColor1);
imageline($NewImage,$line1_x1,40,100,$line1_y2,$LineColor2);

$_SESSION['key']=$random;
header("Content-type: image/png");
imagepng($NewImage);
imagedestroy($NewImage);
?>