<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tutorial\Model\Book;
use Tutorial\Model\BookTable;
use Tutorial\Form\BookForm;

class TutorialController extends AbstractActionController
{
    private $table;

    public function __construct(BookTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $data = $this->table->fetchAll();
        $view = new ViewModel(compact('data'));

        return $view;
    }

    public function aboutAction()
    {
    }

    public function addAction()
    {
        $form = new BookForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $book = new Book();
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $book->exchangeArray($form->getData());
                $this->table->saveBook($book);

                return $this->redirect()->toRoute('tutorial');
            }
        }

        return compact('form');
    }
}
