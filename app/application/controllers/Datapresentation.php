<?php
/**
 * @name DatapresentationController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class DatapresentationController extends BaseController 
{
    public function chartjsAction() {
        $this->renderPage();
    }

    public function chartjs2Action() {
        $this->renderPage();
    }

    public function morisjsAction() {
        $this->renderPage();
    }

    public function echartsAction() {
        $this->renderPage();
    }

    public function otherchartsAction() {
        $this->renderPage();
    }

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
