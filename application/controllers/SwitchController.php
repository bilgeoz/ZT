<?php

class SwitchController extends Zend_Controller_Action
{
    public function init() {}
  
    public function switchAction()
    {
        $session = new Zend_Session_Namespace('ZT');
        $session->language = $this->_getParam('lang');
        $this->_redirect($_SESSION['req_url']);
    }
}