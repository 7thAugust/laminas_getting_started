<?php

namespace Application\Model;

use Application\Entity\Album;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;
use RuntimeException;


class PostCommand implements PostCommandInterface
{
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function insertAlbum(Album $album)
    {
        $insert = new Insert('album');
        $insert->values(
          [
            'title' => $album->getTitle(),
            'artist' => $album->getArtist(),
          ]
        );

        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface) {
            throw new RuntimeException(
              'Database error occurred during album post insert operation'
            );
        }

        $id = $result->getGeneratedValue();

        return new Album($album->getTitle(), $album->getArtist(), $id);
    }


    public function updateAlbum(Album $album)
    {
        // TODO: Implement updateAlbum() method.
    }

    public function deleteAlbum(Album $album)
    {
        // TODO: Implement deleteAlbum() method.
    }

}
