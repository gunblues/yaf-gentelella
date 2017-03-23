<?php
/**
 * @name ExtrasController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class ExtrasController extends BaseController 
{
    public function plainAction() {
        $this->renderPage();
    }

    public function pricingAction() {
        $this->renderPage();
    }

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
