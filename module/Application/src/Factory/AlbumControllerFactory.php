<?php

namespace Application\Factory;

use Application\Controller\AlbumController;
use Application\Model\AlbumRepositoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AlbumControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AlbumController($container->get(AlbumRepositoryInterface::class));
    }

}
