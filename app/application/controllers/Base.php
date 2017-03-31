<?php
/**
 * @name Base
 * @author gunblues
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

class BaseController extends Yaf_Controller_Abstract 
{
        
    public $cc = "tw";
    public $mobile = 0;
    public $parameter = "";
    public $user = null;
    public $mobileTemplateName = "";

    public static $allow_locale = array("tw");

    public function init() { //{{{
        MyUtil::blockBadBot();

        $this->mobile = filter_var($this->getRequest()->getQuery('mobile'), FILTER_VALIDATE_INT);

        if (empty($this->mobile)) {
            $this->mobile = filter_var($this->getRequest()->getQuery('m'), FILTER_VALIDATE_INT);
        }

        $detectMobile = MyUtil::detectMobile();
        
        if(is_array($detectMobile)) {
            $this->mobile = 1;
        }
        
        $cc = filter_var($this->getRequest()->getQuery('cc'), FILTER_SANITIZE_STRING);

        if ($cc === "") {
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $cc = substr($lang[0], -2);
            }
        }

        $cc = strtolower($cc);
        
        if(!in_array($cc, self::$allow_locale)) {
            $cc = "tw";
        }

        if (!defined("SITE_NAME")) {
            Yaf_loader::import(dirname(__FILE__) . "/../translate/$cc/words.php");
        }

        $this->cc = $cc;

        $this->getView()->cc = $this->cc;

        $this->parameter = "cc=" . $this->cc . "&m=" . $this->mobile;

        $this->getView()->parameter = $this->parameter;

        if (User::isLoggedIn()) {
            $this->user = User::getUserData();
        } else {
            $this->user = User::getGuestData();
        }

        $this->getView()->user = $this->user;

    } //}}}

    public function renderPage($controller = "", $action = "") { //{{{
        
        if ($controller === "") {
            $controller = strtolower($this->getRequest()->getControllerName());
        }

        if ($action === "") {
            $action = $this->getRequest()->getActionName();
        }

        $this->getView()->action = $action;

        $pjax = "/$controller/$action";

        if ($this->mobile === 1) {
            $pjax = $pjax . $this->mobileTemplateName;
        }

        $template = $this->getViewpath() . $pjax . ".phtml";

        if (file_exists($template) && !isset($this->getView()->pageContent)) {
            $this->getView()->pageContent = $template;
        }

        if(isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true') {
            $this->display("..$pjax");
        }
        else {
            $index = "../index/index" . $this->mobile;
            if ($this->mobile === 1) {
                $index = $index . $this->mobileTemplateName;
            }

            $this->display($index);
        }

        Yaf_Dispatcher::getInstance()->disableView();

    } //}}}

    function needLogin() { //{{{
        if (!User::isLoggedIn()) {
            header("Location: /login"); 
            exit;    
        }
    } //}}}

    function logExcpetion($e) { //{{{
        error_log("Exception: ". $this->getRequest()->getControllerName() . " " . $this->getRequest()->getActionName() . " " . $e->getMessage());
    } //}}}
}
