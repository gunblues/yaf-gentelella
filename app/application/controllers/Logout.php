<?php
/**
 * @name LogoutController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class LogoutController extends Yaf_Controller_Abstract 
{
    public function indexAction() {
        User::cleanData();

        header("Location: /");
        exit;
	}
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
