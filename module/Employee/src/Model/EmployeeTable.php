<?php

namespace Employee\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class EmployeeTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
}
