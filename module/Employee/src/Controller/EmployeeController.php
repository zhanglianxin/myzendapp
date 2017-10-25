<?php

namespace Employee\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Employee\Model\Employee;
use Employee\Model\EmployeeTable;

class EmployeeController extends AbstractActionController
{
    private $table;

    public function __construct(EmployeeTable $table)
    {
        $this->table = $table;
    }


    public function indexAction()
    {
        $data = $this->table->fetchAll();
        $view = new ViewModel(compact('data'));

        return $view;
    }
}
