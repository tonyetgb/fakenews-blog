<?php

$counter_expire = 600;
$counter_filename = "stats.txt";
$counter_ignore_agents = array('bot', 'bot1', 'bot3');
$counter_ignore_ips = array('127.0.0.2', '127.0.0.3');
$counter_agent = $_SERVER['HTTP_USER_AGENT'];
$counter_ip = $_SERVER['REMOTE_ADDR']; 
$counter_time = time();

if (file_exists("admin/" . $counter_filename)) {

   $ignore = false;   
   $length = sizeof($counter_ignore_agents);
   for ($i = 0; $i < $length; $i++) {

	  if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i])))

		{
		$ignore = true;
		break;
		}

	}
   
	$length = sizeof($counter_ignore_ips);
	for ($i = 0; $i < $length; $i++) {

		if ($counter_ip == $counter_ignore_ips[$i])

		{
		$ignore = true;
		break;
		}
	}

	$c_file = array();
	$fp = fopen("admin/" . $counter_filename, "r");
   
	if ($fp) {

		$canWrite = false;
		while (!$canWrite)    
		$canWrite = flock($fp, LOCK_EX);

		while (!feof($fp)) {

			$line = trim(fgets($fp, 1024)); 
			if ($line != "")
			$c_file[] = $line;		  
		}

	flock($fp, LOCK_UN);
	fclose ($fp);

	} else {

	$ignore = true;

	}

	if ($ignore == false) {

	$continue_block = array();
	for ($i = 1; $i < sizeof($c_file); $i++) {

		$tmp = explode("||", $c_file[$i]);
		
		if (sizeof($tmp) == 2) {

			list($counter_ip_file, $counter_time_file) = $tmp;
			$counter_time_file = trim($counter_time_file);
	  
			if ($counter_ip == $counter_ip_file && $counter_time-$counter_expire < $counter_time_file) {

				$ignore = true;
				$continue_block[] = $counter_ip . "||" . $counter_time;
	        
	        } else if ($counter_time-$counter_expire < $counter_time_file) {

			$continue_block[] = $counter_ip_file . "||" . $counter_time_file;

				}
			}		 
		}
	}

	if ($ignore == false) {

		if (isset($c_file[0]))
		$tmp = explode("||", $c_file[0]);
		else
		$tmp = array();

		if (sizeof($tmp) == 8) {

			list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = $tmp;
			$day_data = explode(":", $day_arr);
			$yesterday_data = explode(":", $yesterday_arr);
			$yesterday = $yesterday_data[1];

			if ($day_data[0] == (date("z")-1)) {

				$yesterday = $day_data[1];
			
			} else {

				if ($yesterday_data[0] != (date("z")-1))
			
			{
			
				$yesterday = 0; 
		    
			}
		}
		 
		// DAY
		$day = $day_data[1];
		if ($day_data[0] == date("z")) $day++; else $day = 1;
		
		// WEEK
		$week_data = explode(":", $week_arr);
		$week = $week_data[1];
		if ($week_data[0] == date("W")) $week++; else $week = 1;
		
		// MONTH
		$month_data = explode(":", $month_arr);
		$month = $month_data[1];
		if ($month_data[0] == date("n")) $month++; else $month = 1;
		
		// YEAR
		$year_data = explode(":", $year_arr);
		$year = $year_data[1];
		if ($year_data[0] == date("Y")) $year++; else $year = 1;

		// ALL
		$all++;

		$record_time = trim($record_time);
		if ($day > $record) {
	    
	        $record = $day;
		    $record_time = $counter_time;
		
		}

		$online = 1;

		if ($all > 1) {

			$fp = fopen("admin/" . $counter_filename,"w+");

				if ($fp) {

					$canWrite = false;
					while (!$canWrite)    
					$canWrite = flock($fp, LOCK_EX);
        			$add_line1 = date("z") . ":" . $day . "||" . (date("z")-1) . ":" . $yesterday . "||" . date("W") . ":" . $week . "||" . date("n") . ":" . $month . "||" . date("Y") . ":" . $year . "||" . $all . "||" . $record . "||" . $record_time . "\n";		 
					fwrite($fp, $add_line1);
					$length = sizeof($continue_block);

						for ($i = 0; $i < $length; $i++)

						{

						fwrite($fp, $continue_block[$i] . "\n");
						$online++;
						
						}

					fwrite($fp, $counter_ip . "||" . $counter_time . "\n");
					flock($fp, LOCK_UN);
					fclose($fp);

				}
			
			} else {

			$online = 1;  

			}

		} else {

		$yesterday = 0;
		$day = $week = $month = $year = $all = $record = 1;
		$record_time = $counter_time;
		$online = 1;

		}

	} else {

	if (sizeof($c_file) > 0)
	list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
	else
	list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $counter_time);

	// DAY
	$day_data = explode(":", $day_arr);
	$day = $day_data[1];

	// YESTERDAY
	$yesterday_data = explode(":", $yesterday_arr);
	$yesterday = $yesterday_data[1];

	// WEEK
	$week_data = explode(":", $week_arr);
	$week = $week_data[1];

	// MONTH
	$month_data = explode(":", $month_arr);
	$month = $month_data[1];

	// YEAR
	$year_data = explode(":", $year_arr);
	$year = $year_data[1];

	$record_time = trim($record_time);
	$online = sizeof($c_file) - 1;
	if ($online <= 0)
	$online = 1;

	}

} else {

	$add_line = date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $counter_time . "\n" . $counter_ip . "||" . $counter_time . "\n";
	$fp = fopen("admin/" . $counter_filename,"w+");
	if ($fp) {

		$canWrite = false;
		while (!$canWrite)    
		$canWrite = flock($fp, LOCK_EX);

		fwrite($fp, $add_line);
		flock($fp, LOCK_UN);
		fclose($fp);

	}

	$yesterday = 0;
	$day = $week = $month = $year = $all = $record = 1;
	$record_time = $counter_time;
	$online = 1;

}

?>