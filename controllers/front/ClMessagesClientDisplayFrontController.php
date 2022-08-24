<?php 

if(!defined('_PS_VERSION_'))
{
    exit;
}

class ClMessagesClientDisplayFrontController extends ModuleFrontController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:cl_messagesclient/views/templates/front/account-controller.tpl');


    }


}