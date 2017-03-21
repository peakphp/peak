<?php

namespace App;

use Peak\Bedrock\Controller\Front as PeakControllerFront;

/**
 * Application Front Controller
 */
class Front extends PeakControllerFront
{

    public function preDispatch()
    {
    }
        
    public function postRender()
    {
        if(isEnv('dev')) {
            $this->controller->view->debugbar()->show();
        }
    }
}