<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Tutorial\Model\BookTable;

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
}
