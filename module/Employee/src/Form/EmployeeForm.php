<?php

namespace Employee\Form;

use Zend\Form\Form;

class EmployeeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('employee');
    }

    $this->add([
        'name' => 'id',
        'type' => 'hidden',
    ]);
    $this->add([
        'name' => 'emp_name',
        'type' => 'text',
        'options' => [
            'label' => 'Name',
        ],
    ]);
    $this->add([
        'name' => 'emp_job',
        'type' => 'text',
        'options' => [
            'label' => 'Job',
        ],
    ]);
    $this->add([
        'name' => 'submit',
        'type' => 'submit',
        'attributes' => [
            'value' => 'Go',
            'id' => 'submitbutton',
        ],
    ]);
}
