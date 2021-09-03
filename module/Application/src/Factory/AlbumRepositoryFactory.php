<?php

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Application\Entity\Album;
use Application\Model\AlbumRepository;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AlbumRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AlbumRepository(
          $container->get(AdapterInterface::class),
          new ReflectionHydrator(),
          new Album('','','')
        );
    }
}
