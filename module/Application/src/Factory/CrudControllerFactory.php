<?php

namespace Application\Factory;

use Application\Controller\CrudController;
use Application\Form\AlbumForm;
use Application\Model\PostCommandInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;


class CrudControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formElementManager = $container->get('FormElementManager');

        return new CrudController(
          $container->get(PostCommandInterface::class),
          $formElementManager->get(AlbumForm::class)
        );
    }

}
