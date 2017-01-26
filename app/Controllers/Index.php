<?php
namespace App\Controllers;

use Peak\Controller\Action;

/**
 * Index Controller
 */
class Index extends Action
{

    /**
     * preAction() - Executed before controller handle any action (Optionnal)
     */
    public function preAction()
    {
    }

    /**
     * index Action (default controller action)
     */
    public function _index()
    {
        $this->view->message = 'Hello';
    }

    /**
     * postAction() - Executed after controller handle any action (Optionnal)
     */
    public function postAction()
    {
    }
    
}