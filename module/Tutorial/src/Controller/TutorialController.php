<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tutorial\Model\Book;
use Tutorial\Model\BookTable;
use Tutorial\Form\BookForm;
use Zend\View\Model\JsonModel;

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
            $post = array_merge_recursive($request->getPost()->toArray(),
                $request->getFiles()->toArray());

            $form->setData($post);

            if ($form->isValid()) {
                $book->exchangeArray($form->getData());
                $this->table->saveBook($book);

                return $this->redirect()->toRoute('tutorial');
            }
        }

        return compact('form');
    }

    public function ajaxAction()
    {
        $data = $this->table->fetchAll();
        $request = $this->getRequest();
        $query = $request->getQuery();

        if ($request->isXmlHttpRequest() || $query->get('showJson') === '1') {
            $jsonData = [];
            foreach ($data as $sampledata) {
                $temp = [
                    'author' => $sampledata->author,
                    'title' => $sampledata->title,
                    'imagepath' => $sampledata->imagepath,
                ];
                $jsonData[] = $temp;
            }
            $view = new JsonModel($jsonData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel();
        }

        return $view;
    }
}
