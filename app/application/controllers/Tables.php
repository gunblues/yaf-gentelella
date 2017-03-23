<?php
/**
 * @name TablesController
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class TablesController extends BaseController 
{
    public function generalAction() {
        $this->renderPage();
    }

    public function dynamicAction() {
        $this->renderPage();
    }

}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
