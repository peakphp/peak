<?php

namespace App;

use Peak\Bedrock\Controller\FrontController;

/**
 * Application Front Controller
 */
class Front extends FrontController
{

    public function preDispatch()
    {
    }
        
    public function postRender()
    {
        if (isEnv('dev')) {
            $this->controller->view->debugbar()->show();
        }
    }
}