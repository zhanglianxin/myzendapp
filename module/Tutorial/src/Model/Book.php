<?php

namespace Tutorial\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;

class Book implements InputFilterAwareInterface
{
    public $id, $author, $title;

    protected $inputFilter;

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
                    ['name' => 'Int',],
                ],
            ]);

            $inputFilter->add([
                'name' => 'author',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags',],
                    ['name' => 'StringTrim',],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name' => 'title',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags',],
                    ['name' => 'StringTrim',],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                ],
            ]);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function exchangeArray(array $data)
    {
        $this->id = empty($data['id']) ? null : $data['id'];
        $this->author = empty($data['author']) ? null : $data['author'];
        $this->title = empty($data['title']) ? null : $data['title'];
    }
}
