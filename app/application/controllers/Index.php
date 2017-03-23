<?php
/**
 * @name IndexController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class IndexController extends BaseController 
{
    public function indexAction() {
		//$this->needLogin();
       	$this->forward("Dashboard", "first"); 
		return false;
	}
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
