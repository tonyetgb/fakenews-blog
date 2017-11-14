<?php 

// OPEN FILE
$array = explode("\n", file_get_contents('admin/data.txt'));

// CREATE VARIABLES FROM ARRAY
$company = $array[0];
$phone = $array[1];
$email = $array[2];
$address = $array[3];
$city = $array[4];
$state = $array[5];
$zip = $array[6];
$facebook = $array[7];
$twitter = $array[8];
$instagram = $array[9];
$google = $array[10];
$linkedin = $array[11];
$title = $array[12];
$keywords = $array[13];
$description = $array[14];
$logo = "images/" . $array[15];
$template = $array[16];
$HL1 = $array[17];
$B1 = $array[18];
$HL2 = $array[19];
$B2 = $array[20];
$HL3 = $array[21];
$B3 = $array[22];
$HL4 = $array[23];
$B4 = $array[24];
$HL5 = $array[25];
$B5 = $array[26];
$primary = $array[27];
$secondary = $array[28];
$main_image = "images/" . $array[29];
$url = $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . '/';

?>

<!DOCTYPE html>

<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $description ?>">
	<meta name="keywords" content="<?php echo $keywords ?>">
	<meta name="author" content="<?php echo $company ?>">
	<link rel="canonical" href="<?php echo $url ?>">
	
	<meta property="og:title" content="<?php echo $title ?>">
	<meta property="og:description" content="<?php echo $description ?>">
	<meta property="og:url" content="<?php echo $url ?>">
	<meta property="og:image" content="<?php echo $url . $main_image ?>">
	<meta property="og:site_name" content="<?php echo $company ?>">
	
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $title ?>">
	<meta name="twitter:description" content="<?php echo $description ?>">
	<meta name="twitter:image" content="<?php echo $url . $main_image ?>">
	
	<meta name="distribution" content="local">
	<meta name="robots" content="follow,index">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="templates/<?php echo $template . "/" . $template ?>.css" type="text/css" charset="utf-8">
</head>

<body>

<? if (!empty($template)) { include "templates/$template/$template.php"; } else { } ?>
<? if (!empty($template)) { include "admin/stats.php"; } else { } ?>

</body>
</html>