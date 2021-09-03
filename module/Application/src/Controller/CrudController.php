<?php

namespace Application\Controller;

use Application\Form\AlbumForm;
use Application\Model\PostCommandInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Form\FormInterface;
use Laminas\View\Model\ViewModel;

class CrudController extends AbstractActionController
{

    /** @var FormInterface */
    private $form;

    /** @var PostCommandInterface */
    private $command;

    public function __construct(PostCommandInterface $command, AlbumForm $form)
    {
        $this->form = $form;

        $this->command = $command;
    }

    public function addAction()
    {
        $request   = $this->getRequest();

        $viewModel = new ViewModel(['form' => $this->form]);

        if (! $request->isPost()) {
            return $viewModel;
        }

        $this->form->setData($request->getPost());

        if (! $this->form->isValid()) {
            return $viewModel;
        }

        $post = $this->form->getData();
        try {
            $post = $this->command->insertAlbum($post);
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $this->redirect()->toRoute('home');

    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }

}
