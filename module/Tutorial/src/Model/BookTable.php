<?php

namespace Tutorial\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class BookTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        return $resultSet;
    }

    public function getBook($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception('Could not find row ' . $id);
        }

        return $row;
    }

    public function saveBook(Book $book)
    {
        $data = [
            'author' => $book->author,
            'title' => $book->title,
        ];

        $id = (int)$book->id;
        if ($id === 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBook($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new \Exception('Book id does not exist');
            }
        }
    }
}
