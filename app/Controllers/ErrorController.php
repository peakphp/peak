<?php

namespace App\Controllers;

use Peak\Bedrock\Controller\ActionController;

/**
 * Error Controller
 */
class ErrorController extends ActionController
{
    /**
     * index Action (default controller action)
     */
    public function _index()
    {
        $this->view->header()->setCode(404);
    }
}
