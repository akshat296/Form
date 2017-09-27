<?php session_start();
						$img = imagecreate(80, 20);
//displaying the random text on the captcha image
						$black = imagecolorallocate($img, 0, 0, 0); 
						$numero = rand(10000, 99999);
						$number = $black . $numero;
						$_SESSION['check'] = $numero; 
						$white = imagecolorallocate($img, 255, 255, 255); 
						imagestring($img, 10, 8, 3, $numero, $white); 
						header ("Content-type: image/png"); 
						imagepng($img);

?>