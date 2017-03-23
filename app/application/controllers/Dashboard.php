<?php
/**
 * @name DashboardController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class DashboardController extends BaseController 
{
    public function firstAction() {
        $this->needLogin();
        $this->renderPage();
    }

    public function secondAction() {
        $this->renderPage();
    }

    public function thirdAction() {
        $this->renderPage();
    }

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
