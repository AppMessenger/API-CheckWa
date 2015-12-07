<?
/*****************************************
CW API 2015
api@checkwa.com
******************************************/
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Madrid');

/***************** Example config ************************/

	$user = "yourusername"; // Get your user and password: contact with api@checkwa.com
	$password = "yourpassword";
	$prefix = $_GET['prefix'];
	$number = $_GET['number'];

/*********************************************************/
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="cw-class/style.css">
</head>
<?
	include("cw-class/class.cw.php");
	include("cw-class/emoji.php");
	$_cw = new CW();
	$cw = json_decode($_cw->Get($user,$password,$prefix,$number),true);
	if ($cw['response'] == "1") {
		if ($cw['result'] == "Y") {
			// THAT NUMBER USES WHATSAPP
			if (!empty($cw['prefix'])) { echo $cw['prefix']."<br>"; } //PREFIX
			if (!empty($cw['number'])) { echo $cw['number']."<br>"; } //NUMBER
			if (!empty($cw['last'])) {   echo $cw['last']."<br>"; } // LAST CONECTION (UTC/GMT +1 hour)
			if (!empty($cw['status'])) {  echo emoji(urldecode($cw['status']))."<br>"; } // STATUS TEXT WITH EMOJI DECODE OR USE urldecode($cw['status']) FOR PLAIN TEXT
			if ($cw['image'] != "NO") { echo '<img src="'.$cw['image'].'">'; } // IMAGE PROFILE
			else { echo '<img src="'.$cw['image_pre'].'">'; } // TEMPLATE IMAGE PROFILE IF USER DON'T HAVE IMAGE
		}
		else if ($cw['result'] == "N") {
			// THAT NUMBER DON'T USE WHATSAPP
		}
	}
	else { // ERROR CONTROL
		echo "ERROR => ".$cw['error']."<br>";;
		if ($cw['response'] == '5') {
			echo $cw['timeout']."<br>"; // TIME MUST WAIT FOR NEW CHECK
		}
	}
	$_cw->Close();
?>
