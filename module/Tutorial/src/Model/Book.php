<?php

namespace Tutorial\Model;

class Book
{
    public $id, $author, $title;

    public function exchangeArray(array $data)
    {
        $this->id = empty($data['id']) ? null : $data['id'];
        $this->author = empty($data['author']) ? null : $data['author'];
        $this->title = empty($data['title']) ? null : $data['title'];
    }
}
