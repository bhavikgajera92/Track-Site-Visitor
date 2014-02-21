<?php
	#
	#  TRACK SITE STATISTICS
	#
	# Track Site Visitor IP Addresss Total Site Count User Agent and Time Schedule
	# This page is intended to track the User Activity 
	
	# Remote Server Address
	$ip = $_SERVER['REMOTE_ADDR'];
	# Remote User Agent
	$agent = $_SERVER['HTTP_USER_AGENT'];

  # For the Simple Use Only, Not For Commercial Use #Credits-UTrace
  
	$url = 'http://xml.utrace.de/?query='.urlencode($ip);			
	$homepage = file_get_contents($url);
   		
	# Loading the XML File and GET the Contents 
	$xml = simplexml_load_file($url);		
	foreach($xml->children() as $book)
		{
			$ip =	$book->ip;
			$isp =	$book->isp;
			$city =	$book->region;
			$country = $book->countrycode;
			$latt =	$book->latitude;
			$long =	$book->longitude;		
		}
		
	# If Session is Set then 
	if(isset($_SESSION['user_id']))
	{	
		$value = $_SESSION['user_id'];
	}
	else
	{
		$value = 0;
	}	
		
	
	# Insert data into the user_tracking_history Table
	$sql_insert="INSERT INTO `user_tracking_history` (`tracking_user_id`,`tracking_ip`,`tracking_time`,`tracking_user_agent`,`user_isp`,`user_city`,`user_country`,`user_latt`,`user_long`)
		          	VALUES ( '".$value."','".$ip."',NOW(),'".$agent."','".$isp."','".$city."','".$country."','".$latt."','".$long."')"; 
	
	$insert_faq=$obj_db->insert($sql_insert);	
	
?>
