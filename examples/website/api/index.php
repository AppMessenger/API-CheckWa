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
	$prefix = $_POST['prefix'];
	$number = $_POST['number'];

/*********************************************************/
	include("cw-class/class.cw.php");
	include("cw-class/emoji.php");
	$_cw = new CW();
	$cw = json_decode($_cw->Get($user,$password,$prefix,$number),true);
	if ($cw['response'] == "1") {
		if ($cw['result'] == "Y") {
			echo '<div class="cw_yeswhatsapp">Yes! That number uses WhatsApp</div>';  // THAT NUMBER USE WHATSAPP
			?><div class="cw_num"><?
			if (!empty($cw['prefix'])) { echo $cw['prefix']; } //PREFIX
			if (!empty($cw['number'])) { echo $cw['number']."<br>"; } //NUMBER
			?></div><div class="cw_image"><?
			if ($cw['image'] != "NO") { echo '<img src="'.$cw['image'].'">'; } // IMAGE PROFILE
			else { echo '<img src="'.$cw['image_pre'].'">'; } // TEMPLATE IMAGE PROFILE IF USER DON'T HAVE IMAGE
			?></div><div class="cw_last"><?
			if (!empty($cw['last'])) {   echo $cw['last']."<br>"; } // LAST CONECTION (UTC/GMT +1 hour)
			?></div><div class="cw_status"><?
			if (!empty($cw['status'])) {  echo emoji(urldecode($cw['status']))."<br>"; } // STATUS TEXT WITH EMOJI DECODE OR USE urldecode($cw['status']) FOR PLAIN TEXT
			?></div><?
		}
		else if ($cw['result'] == "N") {
			echo '<div class="cw_nowhatsapp">Sorry, that number don\'t uses WhatsApp"</div>'; // THAT NUMBER DON'T USE WHATSAPP
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