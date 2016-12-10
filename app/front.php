<?php
namespace App;

use Peak\Controller\Front as PeakControllerFront;

/**
 * Application Front Controller
 */
class Front extends PeakControllerFront
{
    
    public function preRender()
    {
    }
    
    public function postRender()
    {
        $this->controller->view->debugbar()->show();
    }
}