<?php

namespace Tutorial;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\BookTable::class => function ($container) {
                    $tableGateway = $container->get(Model\BookTableGateway::class);
                    $table = new Model\BookTable($tableGateway);

                    return $table;
                },
                Model\BookTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Book());
                    $tableGateway = new TableGateway('book', $dbAdapter, null,
                        $resultSetPrototype);

                    return $tableGateway;
                },
            ],
        ];
    }
}
