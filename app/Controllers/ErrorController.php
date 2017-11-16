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
        if (isset($this->exception) && is_object($this->exception)) {
            $this->view->error_msg = $this->exception->getMessage();
            $this->view->error_trace = exceptionTrace($this->exception);
        }
    }
}
