<?php
/**
 * @name FormController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class FormController extends BaseController 
{
    public function generalAction() {
        $this->renderPage();
    }

    public function advancedAction() {
        $this->renderPage();
    }

    public function validationAction() {
        $this->renderPage();
    }

    public function wizardsAction() {
        $this->renderPage();
    }

    public function uploadAction() {
        $this->renderPage();
    }

    public function buttonsAction() {
        $this->renderPage();
    }

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
