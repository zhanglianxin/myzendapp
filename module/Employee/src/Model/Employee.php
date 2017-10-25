<?php

namespace Employee\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Employee implements InputFilterAwareInterface
{
    public $id, $emp_name, $emp_job;

    protected $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id = empty($data['id']) ? null : $data['id'];
        $this->emp_name = empty($data['emp_name']) ? null : $data['emp_name'];
        $this->emp_job = empty($data['emp_job']) ? null : $data['emp_job'];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add([
                'name' => 'id',
                'required' => true,
                'filters' => [
                    ['name' => 'Int'],
                ],
            ]);

            $inputFilter->add([
                'name' => 'emp_name',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'emp_job',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                ],
            ]);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
