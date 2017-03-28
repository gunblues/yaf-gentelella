<?php
/**
 * @name LoginController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/config/HybridAuthConfig.php';


class LoginController extends Yaf_Controller_Abstract 
{
    public function indexAction() {
        if (User::isLoggedIn()) {
            header("Location: $done");
            exit;
        }
 
        $provider = filter_var($this->getRequest()->getQuery('provider'), FILTER_SANITIZE_STRING);
        if (empty($provider)) {
            $this->display("../login/login"); 
            exit; 
        }
        
        $done = filter_var($this->getRequest()->getQuery('done'), FILTER_SANITIZE_STRING);

        if (empty($done)) {
            $done = "/";
        }
       
        try{
            global $HybridAuthConfig;
            $hybridauth = new Hybrid_Auth($HybridAuthConfig);

            $authProvider = $hybridauth->authenticate($provider);

            $userProfile = $authProvider->getUserProfile();

            if($userProfile && isset($userProfile->identifier)) {
                User::addUser($provider, $userProfile);
                header("Location: $done");
                exit;
            }
        }
        catch( Exception $e )
        {
            error_log("login exception - code:" . $e->getCode() . ", message:" . $e->getMessage());

        }
        return false;
	}

    public function hybridauthAction() {
        Hybrid_Endpoint::process();
        return false;
    }
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
