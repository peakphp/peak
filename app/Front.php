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
        if (isDev()) {
            echo $this->controller->view->debugBar()->render();
        }
    }
}