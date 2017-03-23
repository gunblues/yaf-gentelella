<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author gunblues
 */

class ErrorController extends Yaf_Controller_Abstract {

    public function errorAction($exception) {
        error_log("exception - " . $exception->getMessage());

        /* error occurs */
        switch ($exception->getCode()) {
            case YAF_ERR_NOTFOUND_MODULE:
            case YAF_ERR_NOTFOUND_CONTROLLER:
            case YAF_ERR_NOTFOUND_ACTION:
            case YAF_ERR_NOTFOUND_VIEW:
                $this->display("page404");
                break;
            default :
                $this->display("page500");
                break;
        }

        exit; 
    }
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
