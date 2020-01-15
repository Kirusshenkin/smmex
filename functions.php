<?php

$token = 'ac743f0d986f309f0dcec13ba5fac65802954a9e';
$apiUrl = 'http://api.smmex.ru';

if(isset($is_login_page)){
    if(isset($_COOKIE['token'])){
        header("Location: /offers.php");
    }
}else{
    if(!isset($_COOKIE['token'])){
        header("Location: /login.php");
    }else{
        $token = $_COOKIE['token'];

        $userInfo = ajax($apiUrl . '/user/info', array('Authorization' => $token));
        $userInfo = json_decode($userInfo);
        if($userInfo->success){
            $userInfo = $userInfo->data;
        }else{
            setcookie('token', null, -1, '/'); 
            header("Refresh:0");
            exit;
        }
    }
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function ajax($url, $params)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false,    // Disabled SSL Cert checks
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $params,
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo($ch);
    curl_close($ch);

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header['content'];
}

function field($fields, $name, $return = false){
	$fields = (array) $fields;

	if(!empty($fields)){
		if(isset($fields[$name])){
			if($return)
				return $fields[$name];

			echo $fields[$name];
		}
	}
	return '';
}

function get_products(){
    global $apiUrl, $token;

    $data = ajax($apiUrl . '/offer/all', array('Authorization' => $token));
    $data = json_decode($data);

    return $data->data;
}
?>