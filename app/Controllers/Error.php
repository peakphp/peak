<?php
namespace App\Controllers;

use Peak\Controller\Action;

/**
 * Error Controller
 */
class Error extends Action
{
    /**
     * index Action (default controller action)
     */
    public function _index()
    {
        $this->view->header()-setCode(404);
    }

}