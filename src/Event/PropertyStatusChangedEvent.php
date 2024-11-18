<?php

namespace App\Event;

use App\Entity\Property;
use Symfony\Contracts\EventDispatcher\Event;

class PropertyStatusChangedEvent extends Event
{
    public const NAME = "property.status_changed";
    private Property $oldProperty;
    private Property $updatedProperty;

    public function __construct(Property $oldProperty, Property $updatedProperty)
    {
        $this->oldProperty = $oldProperty;
        $this->updatedProperty = $updatedProperty;
    }

    public function getOldProperty(): Property
    {
        return $this->oldProperty;
    }

    public function getUpdatedProperty(): Property
    {
        return $this->updatedProperty;
    }

}