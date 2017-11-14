<?php

$color = "# . $primary";
 
  function calc_brightness($color) {
    $rgb = hex2RGB($color);
    return sqrt(
       $rgb["red"] * $rgb["red"] * .299 +
       $rgb["green"] * $rgb["green"] * .587 +
       $rgb["blue"] * $rgb["blue"] * .114);          
  }
 

      $brightness = calc_brightness($color);
      $text_color = ($brightness < 130) ? "#FFFFFF" : "#4C4C4C";

  function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
      $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
      $rgbArray = array();
      if (strlen($hexStr) == 6) {
          $colorVal = hexdec($hexStr);
          $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
          $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
          $rgbArray['blue'] = 0xFF & $colorVal;
      } elseif (strlen($hexStr) == 3) {
          $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
          $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
          $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
      } else {
          return false;
      }
      return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
  }  
 
?>

<style>
.nav-item:hover { background-color: #<?php echo $primary ?>; color: <?php echo $text_color ?>; }
.primary-color { color: #<?php echo $primary ?>; }
.secondary-color { color: #<?php echo $secondary ?>; }
.primary-bg { background-color: #<?php echo $primary ?>; }
a { color: #<?php echo $primary ?>; }
a:hover { color: #<?php echo $secondary ?>; }
input[type=submit] { background-color: #<?php echo $primary ?>; color: <?php echo $text_color ?>; transition: background 0.1s ease-in; }
input[type=submit]:hover { background-color: #<?php echo $secondary ?>; }
.facebook, .twitter, .instagram, .google, .linkedin { background-color: #<?php echo $secondary ?>; transition: background 0.1s ease-in; }
.facebook:hover, .twitter:hover, .instagram:hover, .google:hover, .linkedin:hover { background-color: #<?php echo $primary ?>; }
</style>

<div id="wrapper">

	<!-- HEADER -->
	<div id="header">
	
		<div class="inside">
		
		<? if (!empty($logo)) { echo "<img class='logo' src='$logo' alt='$company' title='$company'>"; } else { } ?>
		
			<? if (!empty($phone)) { echo "<a href='tel:$phone'><div class='nav-item'><b>$phone</b></div></a>"; } else { } ?>
			<a href="#fourth" class="anchor"><div class="nav-item"><?php echo $HL4 ?></div></a>
			<a href="#third" class="anchor"><div class="nav-item"><?php echo $HL3 ?></div></a>
			<a href="#second" class="anchor"><div class="nav-item"><?php echo $HL2 ?></div></a>
		
		</div>
	
	</div>
	
	<!-- BLOCK 1 CONTENT -->
	<div id="main" <? if (!empty($main_image)) { echo "style='background-image: url($main_image);'"; } else { } ?>>
	
		<div class="inside">

			<div id="main-inside">
			<h1><?php echo $HL1 ?></h1>
			<p class="main-text"><?php echo $B1 ?></p>
			</div>
	
		</div>
	
	</div>
	
	<div class="clear"></div>

	<!-- BLOCK 2 CONTENT -->
	<div id="second">
	
		<div class="inside">
		<h2 class="primary-color"><?php echo $HL2 ?></h2>
		<p><?php echo $B2 ?></p>
		</div>

	</div>
	
	<!-- BLOCK 3 CONTENT -->
	<div id="third" class="primary-bg">
	
		<div class="inside">

			<h2 style="color: <?php echo $text_color ?>"><?php echo $HL3 ?></h2>
			<p style="color: <?php echo $text_color ?>"><?php echo $B3 ?></p>

		</div>

	</div>
	
	<!-- BLOCK 4 CONTENT -->
	<div id="fourth">
	
		<div class="inside">

			<div class="two-columns">
			<h2 class="primary-color"><?php echo $HL4 ?></h2>
			<p><?php echo $B4 ?></p>
			
			<!-- CONTACT INFORMATION -->
			<p>
			<? if (!empty($company)) { echo "<b>$company</b><br>"; } else { } ?>
			<? if (!empty($address)) { echo "$address<br>"; } else { } ?>
			<? if (!empty($city)) { echo "$city,&nbsp;"; } else { } ?><? if (!empty($state)) { echo "$state,&nbsp;"; } else { } ?><? if (!empty($zip)) { echo "$zip<br>"; } else { } ?>
			<? if (!empty($phone)) { echo "$phone<br>"; } else { } ?>
			<? if (!empty($email)) { echo "<a href='mailto:$email'>$email</a>"; } else { } ?>
			</p>
			
				<!-- SOCIAL LINKS -->
				<div id="social-block">
				<? if (!empty($facebook)) { echo "<a href='$facebook' target='_blank'><div class='facebook'></div></a>"; } else { } ?>
				<? if (!empty($twitter)) { echo "<a href='$twitter' target='_blank'><div class='twitter'></div></a>"; } else { } ?>
				<? if (!empty($instagram)) { echo "<a href='$instagram' target='_blank'><div class='instagram'></div></a>"; } else { } ?>
				<? if (!empty($google)) { echo "<a href='$google' target='_blank'><div class='google'></div></a>"; } else { } ?>
				<? if (!empty($linkedin)) { echo "<a href='$linkedin' target='_blank'><div class='linkedin'></div></a>"; } else { } ?>
				</div>

			</div>
			
			<!-- BLOCK 5 CONTENT -->
			<div class="two-columns">
			<h2 class="primary-color"><?php echo $HL5 ?></h2>
			<p><?php echo $B5 ?></p>
			</div>
		
		</div>
	
	</div>

</div>

<!-- GOOGLE FONTS -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>

<!-- SCROLL TO -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>