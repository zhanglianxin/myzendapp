<?php

namespace Employee\Model;

class Employee
{
    public $id, $emp_name, $emp_job;

    public function exchangeArray(array $data)
    {
        $this->id = empty($data['id']) ? null : $data['id'];
        $this->emp_name = empty($data['emp_name']) ? null : $data['emp_name'];
        $this->emp_job = empty($data['emp_job']) ? null : $data['emp_job'];
    }
}
