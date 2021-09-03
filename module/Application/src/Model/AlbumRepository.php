<?php

namespace Application\Model;

use InvalidArgumentException;
use RuntimeException;

use Application\Entity\Album;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator\HydratorInterface;

class AlbumRepository implements AlbumRepositoryInterface
{

    private $db;

    private $hydrator;

    private $postPrototype;

    public function __construct(AdapterInterface $db, HydratorInterface $hydrator, Album $postPrototype)
    {
        $this->db = $db;

        $this->hydrator = $hydrator;

        $this->postPrototype = $postPrototype;
    }

    public function findAllAlbums()
    {
        $sql = new Sql($this->db);
        $select = $sql->select('album');
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
            $resultSet->initialize($result);
            return $resultSet;
        }

        die('no data');
    }

    public function findAlbumById($id)
    {
        $sql = new Sql($this->db);
        $select = $sql->select('album');
        $select->where(['id = ?' => $id]);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            throw new RuntimeException(
              sprintf(
                'Failed retrieving blog post with identifier "%s"; unknown database error.',
                $id
              )
            );
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
        $resultSet->initialize($result);
        $album = $resultSet->current();

        if (!$album) {
            throw new InvalidArgumentException(
              sprintf(
                'Blog post with identifier "%s" not found.',
                $id
              )
            );
        }

        return $album;
    }

}