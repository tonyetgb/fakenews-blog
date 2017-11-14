<?php

// PASSWORD
$pass = 'Pa55w0rd';

// NO CACHE
header("Cache-Control: no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// INSTALL NEW TEMPLATE
if (!empty($_POST['install-template'])) {

	// CHECK ZIP UPLOAD
	$zip_name = basename($_FILES["zip"]["name"]);
	$file_ext = strrchr($zip_name, '.');
	$whitelist = array(".zip");
	$new_folder = basename($zip_name, ".zip");

		if (!(in_array($file_ext, $whitelist))) {
			$message = "<div class='error'><b>Whoops...</b>  Your Template must be a ZIP file.</div>";
	    } else {

	//CREATE NEW TEMPLATE FOLDER
	if (!file_exists("../templates/$new_folder")) {
	    mkdir("../templates/$new_folder", 0700);
	}

	// UPLOAD ZIP
	$target_dir = "../templates/$new_folder/";
	$target_file = $target_dir . basename($_FILES["zip"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["zip"]["tmp_name"], $target_file);
	}

	// UNPACK ZIP
	$zip = new ZipArchive;
	if ($zip->open("../templates/$new_folder/$zip_name") === TRUE) {
		$zip->extractTo("../templates/$new_folder/");
		$zip->close();
		unlink("../templates/$new_folder/$zip_name");
		$message = "<div class='success'>Your new Template is installed and ready for use!</div>";

	}

}

// RESTORE FROM BACKUP
if (!empty($_POST['install-backup'])) {

	// UPLOAD BACKUP FILE
	$target_dir = "../admin/";
	$backup_name = basename($_FILES["backup"]["name"]);
	$file_ext = strrchr($backup_name, '.');
	$whitelist = array(".txt");

		if (!(in_array($file_ext, $whitelist))) {
			$message = "<div class='error'><b>Whoops...</b>  Your Backup must be a TXT file.</div>";
		} else {

		$target_file = $target_dir . basename($_FILES["backup"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["backup"]["tmp_name"], $target_file);
		$renameDataFile = rename("$backup_name","data.txt");
		$message = "<div class='success'><b>Good thing you had a backup!</b>  Your website has been restored.</div>";

	}

}

// UPDATE WEBSITE INFO
if (!empty($_POST['update-website'])) {

	// GRAB FORM DATA
	$company = $_POST['company'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$instagram = $_POST['instagram'];
	$google = $_POST['google'];
	$linkedin = $_POST['linkedin'];
	$title = $_POST['title'];
	$keywords = $_POST['keywords'];
	$description = $_POST['description'];
	$b1_hl = $_POST['block1_hl'];
	$b2_hl = $_POST['block2_hl'];
	$b3_hl = $_POST['block3_hl'];
	$b4_hl = $_POST['block4_hl'];
	$b5_hl = $_POST['block5_hl'];
	$block1 = $_POST['block1'];
	$block2 = $_POST['block2'];
	$block3 = $_POST['block3'];
	$block4 = $_POST['block4'];
	$block5 = $_POST['block5'];
	$block1_edit = preg_replace("/\r\n|\r|\n/",'<br/>',$block1);
	$block2_edit = preg_replace("/\r\n|\r|\n/",'<br/>',$block2);
	$block3_edit = preg_replace("/\r\n|\r|\n/",'<br/>',$block3);
	$block4_edit = preg_replace("/\r\n|\r|\n/",'<br/>',$block4);
	$block5_edit = preg_replace("/\r\n|\r|\n/",'<br/>',$block5);
	$template = $_POST['template'];
	$primary = $_POST['primary'];
	$secondary = $_POST['secondary'];

	// UPLOAD NEW LOGO
	if (!empty($_FILES["logo"]["name"])) {

		$target_dir = "../images/";
		$logo_name = basename($_FILES["logo"]["name"]);
		$file_ext = strrchr($logo_name, '.');
		$whitelist = array(".jpg",".jpeg",".gif",".png");

			if (!(in_array($file_ext, $whitelist))) {
				$error_1 = "Your logo wasn't uploaded - it must be in JPG, GIF or PNG format.";
				$logo = $_POST['original_logo'];
			} else {

			$target_file = $target_dir . basename($_FILES["logo"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
			$logo = $logo_name;

		}

	// OR KEEP ORIGINAL LOGO
	} else {

	$logo = $_POST['original_logo'];

	}

	// UPLOAD MAIN IMAGE
	if (!empty($_FILES["main_image"]["name"])) {

		$target_dir = "../images/";
		$main_image_name = basename($_FILES["main_image"]["name"]);
		$file_ext = strrchr($main_image_name, '.');
		$whitelist = array(".jpg",".jpeg",".gif",".png");

			if (!(in_array($file_ext, $whitelist))) {
				$error_2 = "Your Main Image wasn't uploaded - it must be in JPG, GIF or PNG format";
				$main_image = $_POST['original_main_image'];
			} else {

		$target_file = $target_dir . basename($_FILES["main_image"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["main_image"]["tmp_name"], $target_file);
		$main_image = $main_image_name;
		}

	// OR KEEP ORIGINAL MAIN IMAGE
	} else {

		$main_image = $_POST['original_main_image'];

	}

	// SAVE TO DATA FILE
	$fp = fopen("data.txt", "w");
	$savestring = $company . "\n" . $phone . "\n" . $email . "\n" . $address . "\n" . $city . "\n" . $state . "\n" . $zip . "\n" . $facebook . "\n" . $twitter . "\n" . $instagram . "\n" . $google . "\n" . $linkedin . "\n" . $title . "\n" . $keywords . "\n" . $description . "\n" . $logo . "\n" . $template . "\n" . $b1_hl . "\n" .$block1_edit . "\n" . $b2_hl . "\n" .$block2_edit . "\n" . $b3_hl . "\n" .$block3_edit . "\n" . $b4_hl . "\n" .$block4_edit . "\n" . $b5_hl . "\n" .$block5_edit . "\n" . $primary . "\n" . $secondary . "\n" . $main_image;
	fwrite($fp, $savestring);
	fclose($fp);
	$message = "<div class='success'>Your website has been updated!&nbsp;&nbsp;<b>PS, it's looking great!</b></div>";

	if (!empty($error_1)) { $error_message_1 = "<div class='error'>$error_1</div>";  } else { }
	if (!empty($error_2)) { $error_message_2 = "<div class='error'>$error_2</div>";  } else { }

}

// OPEN DATA FILE
$array = explode("\n", file_get_contents('data.txt'));

// ADD BREAKS TO BLOCK CONTENT
$breaks = array("<br />","<br>","<br/>");
$block1 = $array[18];
$block2 = $array[20];
$block3 = $array[22];
$block4 = $array[24];
$block5 = $array[26];
$block1_edit = str_ireplace($breaks, "\r\n", $block1);
$block2_edit = str_ireplace($breaks, "\r\n", $block2);
$block3_edit = str_ireplace($breaks, "\r\n", $block3);
$block4_edit = str_ireplace($breaks, "\r\n", $block4);
$block5_edit = str_ireplace($breaks, "\r\n", $block5);

// GET AVAILABLE TEMPLATES
$path = '../templates/' . $name[0];
$results = scandir($path);

// GET STATS
$filename = 'stats.txt';

	if (file_exists($filename)) {
	$stats = explode("||", file_get_contents('stats.txt'));
	$day = explode(":", $stats[0]);
	$yesterday = explode(":", $stats[1]);
	$week = explode(":", $stats[2]);
	$month = explode(":", $stats[3]);
	$year = explode(":", $stats[4]);
	$all = explode(":", $stats[5]);
	} else {
	$day[1] = 0;
	$yesterday[1] = 0;
	$week[1] = 0;
	$month[1] = 0;
	$year[1] = 0;
	$all[1] = 0;
	}

?>

<!DOCTYPE html>

<head>
	<title><?php echo $array[0] ?> Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="style-admin.css" type="text/css" charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="jscolor/jscolor.js"></script>
</head>

<script type="text/javascript">

// SHOW MENU ITEMS SELECTED
function toggle_visibility(id) {
var e = document.getElementById(id);
	if(e.style.display == 'block')
		e.style.display = 'none';
	else
		e.style.display = 'block';
}

// SHOW COMLETED ITEMS IN GREEN
function checkFilled(id, div) {
	var inputVal = document.getElementById(id);
	var overlay = document.getElementById(div);
    if (inputVal.value == "") {
        overlay.style.backgroundColor = "";
    }
    else{
        overlay.style.backgroundColor = "#39c166";
    }
}

// SHOW SELECTED BLOCK
$(function() {
	$('#blocks').change(function(){
		$('.block').hide();
		$('#' + $(this).val()).show();
		});
	});

// HIDE NOTIFICATIONS
setTimeout(function() {
    $('#notification').fadeOut('fast');
}, 7000);

</script>

<body>

<?php

if ($_GET['pass'] === "$pass") {

?>

<div id="wrapper">

	<!-- HEADER -->
	<div id="header">

		<div id="header-inside">

			<h1><?php echo $array[0] ?> Admin</h1>
			<a href="#" onclick="toggle_visibility('website-backup');" alt="Website Backup" title="Website Backup"><div class="hb-hide header-button hb-backup"></div></a>
			<a href="#" onclick="toggle_visibility('template-install');" alt="Install Template" title="Install Template"><div class="hb-hide header-button hb-install"></div></a>
			<a href="https://www.tinystack.net" target="_blank" alt="Download Templates" title="Download Templates"><div class="hb-hide header-button hb-template"></div></a>
			<a href="#" onclick="toggle_visibility('stats-main');" alt="View Statistics" title="View Statistics"><div class="header-button hb-stats"></div></a>
			<a href="../index.php" target="_blank" alt="View Website" title="View Website"><div class="header-button hb-website"></div></a>

		</div>

	</div>

	<!-- ADMIN MAIN -->
	<div id="admin-main">

		<div id="notification">
		<?php echo $message ?>
		<?php echo $error_message_1 ?>
		<?php echo $error_message_2 ?>
		</div>

		<!-- STATS MAIN -->
		<div id="stats-main">

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($day[1]); ?></p>
				<p class="stats-timeframe">TODAY</p>
			</div>

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($yesterday[1]); ?></p>
				<p class="stats-timeframe">YESTERDAY</p>
			</div>

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($week[1]); ?></p>
				<p class="stats-timeframe">THIS WEEK</p>
			</div>

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($month[1]); ?></p>
			<p class="stats-timeframe">THIS MONTH</p>
			</div>

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($year[1]); ?></p>
				<p class="stats-timeframe">THIS YEAR</p>
			</div>

			<div class="stats-item">
				<p class="stats-count"><?php echo number_format($all[0]); ?></p>
				<p class="stats-timeframe">TOTAL</p>
			</div>

			<div class="clear"></div>

		</div>

		<!-- TEMPLATE INSTALL -->
		<div id="template-install">

			<form method="post" enctype="multipart/form-data">

			<h2>How to Install A New Template</h2>
			<p>Installing a new template is easy, click on the ZIP button and upload the ZIP file of the template you downloaded. <b>Do not change the ZIP file name or names of the files inside</b>, doing so will result in your template not working.</p>
			<p>Once the ZIP button is green, click the 'Install New Template' button. After it's installed you can use it by changing the current template under Template Settings (section 6).</p>

			<div class="zip-upload" id="zip-upload">
			<input type="file" name="zip" id="zip" onchange="checkFilled('zip', 'zip-upload');">
			</div>

			<input type="submit" name="install-template" class="install-button" value="Install New Template">

			</form>

			<div class="clear"></div>

		</div>

		<!-- WEBSITE BACKUP -->
		<div id="website-backup">

			<form method="post" enctype="multipart/form-data">

			<h2>Backup or Restore Your Website</h2>
			<p>Every once in a while it's great to have a backup of the content on your website - <i>just in case</i>. <a href="data.txt" download>Click Here</a> to download a backup of your website.</p>
			<p>If you need to restore your website from a backup, choose the backup file (usually called data.txt) and click 'Restore From Backup'.</p>

			<div class="backup-upload" id="backup-upload">
			<input type="file" name="backup" id="backup" onchange="checkFilled('backup', 'backup-upload');">
			</div>

			<input type="submit" name="install-backup" class="install-button" value="Restore From Backup">

			</form>

			<div class="clear"></div>

		</div>

	<!-- WEBSITE EDIT FORM -->
	<form method="post" enctype="multipart/form-data">

	<input type="hidden" name="original_logo" id="original_logo" value="<?php echo $array[15] ?>">
	<input type="hidden" name="original_main_image" id="original_main_image" value="<?php echo $array[29] ?>">

		<div id="admin-left">

			<div class="admin-step">1</div>
			<h2>Company Information</h2>

		<input type="text" name="company" id="company" value="<?php echo $array[0] ?>" placeholder="Company Name">
		<input type="text" name="phone" id="phone" value="<?php echo $array[1] ?>" placeholder="Phone Number">
		<input type="text" name="email" id="email" value="<?php echo $array[2] ?>" placeholder="Email Address">

			<div class="logo-upload" id="logo-upload" alt="Upload Your Logo" title="Upload Your Logo">
			<input type="file" name="logo" id="logo" onchange="checkFilled('logo', 'logo-upload');">
			</div>

			<div class="clear"></div>
			<div class="admin-step">2</div>
			<h2>Address Information</h2>

		<input type="text" name="street" id="street" value="<?php echo $array[3] ?>" placeholder="Street Address">
		<input type="text" name="city" id="city" value="<?php echo $array[4] ?>" placeholder="City">
		<input type="text" name="state" id="state" value="<?php echo $array[5] ?>" placeholder="State">
		<input type="text" name="zip" id="zip" value="<?php echo $array[6] ?>" placeholder="Zip Code">

			<div class="clear"></div>
			<div class="admin-step">3</div>
			<h2>Social Profile Links</h2>

		<input type="text" name="facebook" id="facebook" value="<?php echo $array[7] ?>" placeholder="https://www.facebook.com/username">
		<input type="text" name="twitter" id="twitter" value="<?php echo $array[8] ?>" placeholder="https://twitter.com/username">
		<input type="text" name="instagram" id="instagram" value="<?php echo $array[9] ?>" placeholder="https://instagram.com/username">
		<input type="text" name="google" id="google" value="<?php echo $array[10] ?>" placeholder="https://plus.google.com/profile">
		<input type="text" name="linkedin" id="linkedin" value="<?php echo $array[11] ?>" placeholder="https://www.linkedin/profile">

		</div>

		<div id="admin-right">

			<div class="clear"></div>
			<div class="admin-step">4</div>
			<h2>Search Engine Information</h2>

		<input type="text" name="title" id="title" value="<?php echo $array[12] ?>" placeholder="Website Title">
		<input type="text" name="keywords" id="keywords" value="<?php echo $array[13] ?>" placeholder="Website Keywords">
		<input type="text" name="description" id="description" value="<?php echo $array[14] ?>" placeholder="Website Description">

			<div class="clear"></div>
			<div class="admin-step">5</div>
			<h2>Edit Content Blocks</h2>

		<div class="styled-select">
		<select name="blocks" id="blocks">
			<option value="one"><? if (!empty($array[17])) { if (strlen($array[17]) > 30) { echo "Edit: " . substr($array[17], 0, 30) . "..."; } else { echo "Edit: $array[17]"; } } else { echo "Edit: Block 1"; } ?></option>
			<option value="two"><? if (!empty($array[19])) { if (strlen($array[19]) > 30) { echo "Edit: " . substr($array[19], 0, 30) . "..."; } else { echo "Edit: $array[19]"; } } else { echo "Edit: Block 2"; } ?></option>
			<option value="three"><? if (!empty($array[21])) { if (strlen($array[21]) > 30) { echo "Edit: " . substr($array[21], 0, 30) . "..."; } else { echo "Edit: $array[21]"; } } else { echo "Edit: Block 3"; } ?></option>
			<option value="four"><? if (!empty($array[23])) { if (strlen($array[23]) > 30) { echo "Edit: " . substr($array[23], 0, 30) . "..."; } else { echo "Edit: $array[23]"; } } else { echo "Edit: Block 4"; } ?></option>
			<option value="five"><? if (!empty($array[25])) { if (strlen($array[25]) > 30) { echo "Edit: " . substr($array[25], 0, 30) . "..."; } else { echo "Edit: $array[25]"; } } else { echo "Edit: Block 5"; } ?></option>
		</select>
		</div>

			<div id="one" class="block">
			<input type="text" name="block1_hl" id="block1_hl" value="<?php echo $array[17] ?>" placeholder="Block Title">
			<textarea name="block1" id="block1" placeholder="Block Text"><?php echo $block1_edit ?></textarea>
			</div>

			<div id="two" class="block" style="display:none;">
			<input type="text" name="block2_hl" id="block2_hl" value="<?php echo $array[19] ?>" placeholder="Block Title">
			<textarea name="block2" id="block2" placeholder="Block Text"><?php echo $block2_edit ?></textarea>
			</div>

			<div id="three" class="block" style="display:none;">
			<input type="text" name="block3_hl" id="block3_hl" value="<?php echo $array[21] ?>" placeholder="Block Title">
			<textarea name="block3" id="block3" placeholder="Block Text"><?php echo $block3_edit ?></textarea>
			</div>

			<div id="four" class="block" style="display:none;">
			<input type="text" name="block4_hl" id="block4_hl" value="<?php echo $array[23] ?>" placeholder="Block Title">
			<textarea name="block4" id="block4" placeholder="Block Text"><?php echo $block4_edit ?></textarea>
			</div>

			<div id="five" class="block" style="display:none;">
			<input type="text" name="block5_hl" id="block5_hl" value="<?php echo $array[25] ?>" placeholder="Block Title">
			<textarea name="block5" id="block5" placeholder="Block Text"><?php echo $block5_edit ?></textarea>
			</div>

			<div class="clear"></div>
			<div class="admin-step">6</div>
			<h2>Template Settings</h2>

			<div class="styled-select">
			<select name="template" id="template">
			<option value="<?php echo $array[16] ?>" selected="selected">Current: <?php echo str_replace('_', ' ', $array[16]) ?></option>
			<option value="">----------</option>
			<?php

				foreach ($results as $result) {

					if ($result === '.' or $result === '..') continue;
					$name_view = str_replace('_', ' ', $result);
					if (is_dir($path . '/' . $result)) {
					echo "<option value=\"$result\">$name_view</option>\n";

					}

				}

			?>
			</select>
			</div>

		<input type="text" class="color {pickerFace:0,pickerBorderColor:'#f1f5f8',pickerInsetColor:'#f1f5f8',required:false} c1" name="primary" id="primary" value="<?php echo $array[27] ?>" placeholder="Primary Color">
		<input type="text" class="color {pickerFace:0,pickerBorderColor:'#f1f5f8',pickerInsetColor:'#f1f5f8',required:false} c2" name="secondary" id="secondary" value="<?php echo $array[28] ?>" placeholder="Secondary Color">

			<div class="main-upload" id="main-upload" alt="Upload Main Image" title="Upload Main Image">
			<input type="file" name="main_image" id="main_image" onchange="checkFilled('main_image', 'main-upload');">
			</div>

		</div>

		<input type="submit" name="update-website" class="button" value="All Done? Click Here to Update Your Website!">

	</form>

	<?php

	} else {

	?>

    <!-- ERROR / BLANK SCREEN -->

	<?php

	}

	?>
		<div class="clear"></div>

	</div>

</div>

</body>
</html>
