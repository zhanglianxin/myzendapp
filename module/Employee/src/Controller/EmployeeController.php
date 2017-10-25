<?php

namespace Employee\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Employee\Model\Employee;
use Employee\Model\EmployeeTable;
use Employee\Form\EmployeeForm;

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

    public function addAction()
    {
        $form = new EmployeeForm();

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $employee = new Employee();
            $form->setInputFilter($employee->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $employee->exchangeArray($form->getData());
                $this->table->saveEmployee($employee);

                return $this->redirect()->toRoute('employee');
            }
        }

        return compact('form');
    }
}
