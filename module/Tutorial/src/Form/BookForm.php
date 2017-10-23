<?php

namespace Tutorial\Form;

use Zend\Form\Form;

class BookForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('book');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'author',
            'type' => 'text',
            'options' => [
                'label' => 'Author',
            ],
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
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

        $this->add([
            'name' => 'imagepath',
            'type' => 'file',
            'options' => [
                'label' => 'Picture',
            ],
        ]);
    }
}
