<?php
namespace App;

use Peak\Controller\Front as PeakControllerFront;

/**
 * App Front Controller
 */
class Front extends PeakControllerFront
{
    
    public function postRender()
    {
        $this->controller->view->debugbar()->show();
    }
}