<?php
$dbname = "thermosp_thermospascom";
$db = mysql_connect("localhost", "thermosp_tscom", "*tscom07");
mysql_select_db("thermosp_thermospascom",$db);
//echo "success";
$table	= "ht_form";
$table2 = "leads";
json_encode( $_POST );

$email		= $_POST['email'];
$address	= $_POST['address'];
$city		= $_POST['city'];
$state1		= $_POST['state1'];
$ts_token 	= $_POST['ts_token'];

$sql_ts_form = "UPDATE ".$table."
		SET `email` = '".$email."',
		`address1` = '".$address."',
		`city` = '".$city."',
		`state` = '".$state1."'
		WHERE `ht_token` = '".$ts_token."'";

$sql_leads = "UPDATE ".$table2."
		SET `email` = '".$email."',
		`address1` = '".$address."',
		`city` = '".$city."',
		`state` = '".$state1."'
		WHERE `leads_token` = '".$ts_token."'";

if(mysql_query($sql_ts_form) && mysql_query($sql_leads)):
else:
endif;

?>
