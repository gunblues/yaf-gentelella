<?php
/**
 * @name LogoutController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/config/HybridAuthConfig.php';

class LogoutController extends Yaf_Controller_Abstract 
{
    public function indexAction() {
        User::cleanData();

        global $HybridAuthConfig;
        $hybridauth = new Hybrid_Auth($HybridAuthConfig);
        $hybridauth->logoutAllProviders();

        header("Location: /");
        exit;
	}
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
