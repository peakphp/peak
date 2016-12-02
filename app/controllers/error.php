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
        $this->view->header()-setRCode(404);
        header('HTTP/1.1 404 Not Found');
    }

}