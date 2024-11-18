<?php

namespace App\Event;

use App\Entity\Property;
use Symfony\Contracts\EventDispatcher\Event;

class PropertyUpdatedEvent extends Event
{
    public const NAME = "property.updated";
    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function getProperty(): Property
    {
        return $this->property;
    }

}