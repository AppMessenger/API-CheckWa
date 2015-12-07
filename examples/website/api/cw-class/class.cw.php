<?php
/*****************************************
CW API 2015
api@checkwa.com
******************************************/
class CW {
    public function __construct() { 
        $this->ch = curl_init();
        $this->base_url = "http://www.checkwa.com/app/index.php";
    }
    public function Get($cw_user,$cw_password,$cw_prefix,$cw_number,$debug=1) {
        curl_setopt($this->ch, CURLOPT_URL, $this->base_url);
        curl_setopt($this->ch, CURLOPT_POST,true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'user='.$cw_user.'&password='.$cw_password.'&prefix='.$cw_prefix.'&number='.$cw_number);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR,"cookie.txt");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_ENCODING , "");
        $response = curl_exec($this->ch);
        return $response;
    }
    public function Close() {
        curl_close($this->ch);
    }
}
?>
