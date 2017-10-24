<?php

namespace TutorialTest\Controller;

use Tutorial\Controller\TutorialController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TutorialControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
                include __DIR__ . '/../../../../config/application.config.php',
                $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/tutorial', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('tutorial');
        $this->assertControllerName(TutorialController::class);
        $this->assertControllerClass('TutorialController');
        $this->assertMatchedRouteName('tutorial1');
    }
}
