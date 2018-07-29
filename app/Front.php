<?php

namespace App;

use Peak\Bedrock\Controller\FrontController;

/**
 * Application Front Controller
 */
class Front extends FrontController
{

    /**
     * Before controller dispatching
     */
    public function preDispatch()
    {
    }

    /**
     * After view rendering
     */
    public function postRender()
    {
        if (isDev()) {
            echo $this->controller->view->debugBar()->render();
        }
    }
}