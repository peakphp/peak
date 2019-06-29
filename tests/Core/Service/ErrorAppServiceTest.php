<?php

use \PHPUnit\Framework\TestCase;
use \Core\Service\ErrorAppService;

class ErrorAppServiceTest extends TestCase
{
    public function testRun()
    {
        $errorAppService = new ErrorAppService();
        ob_start();
        $errorAppService->run('dev', new \Exception('An error occurred'), null);
        $content = ob_get_clean();
        $this->assertTrue($content === 'An error occurred');
    }
}
