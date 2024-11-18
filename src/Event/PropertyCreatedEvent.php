<?php

namespace App\Event;

use App\Entity\Property;
use Symfony\Contracts\EventDispatcher\Event;

class PropertyCreatedEvent extends Event
{
    public const NAME = "property.created";
    private Property $property;

    public function __construct(Property $property) {
        $this->property = $property;
    }

    public function getProperty(): Property
    {
        return $this->property;
    }
}