<?php

namespace Application\Form;

use Laminas\Form\Fieldset;
use Application\Entity\Album;
use Laminas\Hydrator\ReflectionHydrator;

class AlbumFieldset extends Fieldset
{

    public function init()
    {
        $this->setHydrator(new ReflectionHydrator());
        $this->setObject(new Album('', '', ''));

        $this->add(
          [
            'type' => 'hidden',
            'name' => 'id',
          ]
        );
        $this->add(
          [
            'type' => 'text',
            'name' => 'title',
            'options' => [
              'label' => 'Post Title',
            ],
          ]
        );
        $this->add(
          [
            'type' => 'text',
            'name' => 'artist',
            'options' => [
              'label' => 'Post Artist',
            ],
          ]
        );
    }

}
