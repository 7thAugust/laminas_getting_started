<?php

namespace Application\Model;

use Application\Entity\Album;

interface PostCommandInterface
{
    public function insertAlbum(Album $album);

    public function updateAlbum(Album $album);

    public function deleteAlbum(Album $album);

}
