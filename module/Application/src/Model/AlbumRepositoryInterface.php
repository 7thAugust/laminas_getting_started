<?php

namespace Application\Model;

interface AlbumRepositoryInterface
{
    public function findAllAlbums();

    public function findAlbumById($id);
}
