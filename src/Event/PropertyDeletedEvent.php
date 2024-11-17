<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class PropertyDeletedEvent extends Event
{
    public const NAME = "property.deleted";
    private string $propertyTitle;

    public function __construct(string $propertyTitle) {
        $this->propertyTitle = $propertyTitle;
    }

    public function getPropertyTitle(): string
    {
        return $this->propertyTitle;
    }
}