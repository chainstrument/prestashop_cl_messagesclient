<?php 

if(!defined('_PS_VERSION_'))
{
    exit;
}

include_once __DIR__ . '/../../classes/Messages.php';

class cl_messagesclientdisplayModuleFrontController extends ModuleFrontController
{


    public function __construct()
    {
         
        parent::__construct();
    }

    public function initContent()
    {
        parent::initContent();


        $options = array();
        foreach (Customer::getCustomers() as $user)
        {
          $options[] = array(
            "id_customer" => (int)$user['id_customer'],
            "name" => $user['firstname']
          );
        }

        // In the template, we need the vars paymentId & paymentStatus to be defined
  $this->context->smarty->assign(
    array(
      'users' => $options, // Retrieved from GET vars
    
    ));
  
        $this->setTemplate('module:cl_messagesclient/views/templates/front/display.tpl');


    }


    public function postProcess()
    {
        parent::postProcess();

        $message = new Messages();
        $message->subject = Tools::getValue('subject');
        $message->message = Tools::getValue('message');
        $message->id_user = Tools::getValue('id_customer');
        dump($message);
        $message->save();
    }

}