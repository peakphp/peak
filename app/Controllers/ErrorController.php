<?php

namespace App\Controllers;

use Peak\Bedrock\Controller\Action;

/**
 * Error Controller
 */
class ErrorController extends Action
{
    /**
     * index Action (default controller action)
     */
    public function _index()
    {
        $this->view->header()->setCode(404);
    }
}
