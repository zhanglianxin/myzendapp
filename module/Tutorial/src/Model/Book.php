<?php

namespace Tutorial\Model;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;

use Zend\Filter\File\RenameUpload;
use Zend\Validator\File\UploadFile;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;

class Book implements InputFilterAwareInterface
{
    public $id, $author, $title, $imagepath;

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

            $file = new FileInput('imagepath');
            $file->getValidatorChain()->attach(new UploadFile());
            $renameUpload = new RenameUpload([
                'target' => './public/tmpuploads/file',
                'randomize' => true,
                'use_upload_extension' => true,
            ]);
            $file->getFilterChain()->attach($renameUpload);
            $inputFilter->add($file);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function exchangeArray(array $data)
    {
        $this->id = empty($data['id']) ? null : $data['id'];
        $this->author = empty($data['author']) ? null : $data['author'];
        $this->title = empty($data['title']) ? null : $data['title'];
        if (!empty($data['imagepath'])) {
            if (is_array($data['imagepath'])) {
                $this->imagepath = str_replace('./public', '', $data['imagepath']['tmp_name']);
            } else {
                $this->imagepath = $data['imagepath'];
            }
        } else {
            $data['imagepath'] = null;
        }
    }
}
