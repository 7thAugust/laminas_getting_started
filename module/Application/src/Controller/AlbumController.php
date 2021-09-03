<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Model\AlbumRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
    private $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function indexAction()
    {
        return new ViewModel(
          ['albums' => $this->albumRepository->findAllAlbums()]
        );
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        if (!$id || $id == 0) {
            return $this->redirect()->toRoute('home');
        }

        $album = $this->albumRepository->findAlbumById($id);

        return new ViewModel(
          ['album' => $album]
        );
    }

}
