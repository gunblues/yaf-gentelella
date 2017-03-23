<?php

class MyUtil {

    static function detectMobile($iphone=true, $ipad=true, $android=true, $opera=true, $blackberry=true, $palm=true, $windows=true, $mobileredirect=false, $desktopredirect=false) { //{{{

        $mobile_browser = false;
        if (!array_key_exists('HTTP_USER_AGENT', $_SERVER) || !array_key_exists('HTTP_ACCEPT', $_SERVER)) {
            return false;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $accept = $_SERVER['HTTP_ACCEPT'];

        switch(true) {

            case (preg_match('/ipad/i', $user_agent)):
                break;
                $mobile_browser = $ipad;
                $status = 'Apple iPad';
                if (substr($ipad,0,4) == 'http'){
                    $mobileredirect = $ipad;
                }
                break;

            case (preg_match('/ipod/i', $user_agent) || preg_match('/iphone/i',$user_agent)):
                $mobile_browser = $iphone;
                $status = 'Apple';
                if (substr($iphone, 0, 4) == 'http') {
                    $mobileredirect = $iphone;
                }
                break;

            case (preg_match('/android/i', $user_agent)):
                $mobile_browser = $android;
                $status = 'Android';
                if (substr($android,0,4) == 'http') {
                    $mobileredirect = $android;
                }
                break;

            case (preg_match('/opera mini/i',$user_agent)):
                $mobile_browser = $opera;
                $status = 'Opera';
                if (substr($opera,0,4) == 'http') {
                    $mobileredirect = $opera;
                }
                break;

            case (preg_match('/blackberry/i',$user_agent)):
                $mobile_browser = $blackberry;
                $status = 'Blackberry';
                if (substr($blackberry,0,4) == 'http') {
                    $mobileredirect = $blackberry;
                }
                break;

            case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent)):
                $mobile_browser = $palm;
                $status = 'Palm';
                if (substr($palm,0,4) == 'http') {
                    $mobileredirect = $palm;
                }
                break;

            case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i', $user_agent)):
                $mobile_browser = $windows;
                $status = 'Windows Smartphone';
                if (substr($windows,0,4) == 'http') {
                    $mobileredirect = $windows;
                }
                break;

            case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i',$user_agent)):
                $mobile_browser = true;
                $status = 'Mobile matched on piped preg_match';
                break;

            case ((strpos($accept,'text/vnd.wap.wml')>0) || (strpos($accept,'application/vnd.wap.xhtml+xml') > 0)):
                $mobile_browser = true;
                $status = 'Mobile matched on content accept header';
                break;

            case (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])):
                $mobile_browser = true;
                $status = 'Mobile matched on profile headers being set';
                break;

            default:
                $mobile_browser = false;
                $status = 'Desktop / full capability browser';
                break;

        }

        if ($redirect = ($mobile_browser == true) ? $mobileredirect : $desktopredirect) {
            header('Location: ' . $redirect);
            exit;
        }
        else {
            if ($mobile_browser=='') {
                return $mobile_browser;
            }
            else {
                return array($mobile_browser, $status);
            }
        }

    }  //}}}

    //origin: http://blackbe.lt/advanced-method-to-obtain-the-client-ip-in-php/
	static function getIpAddress() { //{{{
	    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
	    foreach ($ip_keys as $key) {
	        if (array_key_exists($key, $_SERVER) === true) {
	            foreach (explode(',', $_SERVER[$key]) as $ip) {
	                // trim for safety measures
	                $ip = trim($ip);
	                // attempt to validate IP
	                if (self::validateIp($ip)) {
	                    return $ip;
	                }
	            }
	        }
	    }
	    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
	} //}}}
	/**
	 * Ensures an ip address is both a valid IP and does not fall within
	 * a private network range.
	 */
    static function validateIp($ip) //{{{
	{
	    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
	        return false;
	    }
	    return true;
	} //}}}

    static function blockBadBot() { //{{{
        $bots = array(
            "Sogou web spider",
            "MJ12bot",
            "Trend Micro WTP",
            "EasouSpider",
            "YYSpider",
        );
    
        if(array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            foreach($bots as $bot) {
                if(stristr($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
                    exit();
                }
            }
        } 
    
      return false;

    } //}}}

    static function isBot() { //{{{
        $bots = array(
            "Googlebot",
            "Mediapartners-Google",
            "Feedfetcher-Google",
            "bingbot",
            "msnbot",
            "YahooYSMcm",
            "Yahoo! Slurp",
        );
    
        if(array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            foreach($bots as $bot) {
                if(stristr($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
                    return true;
                }
            }
        } 
    
      return false;
    } //}}}

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
