<?php

namespace App\Service;

use App\Event\PropertyCreatedEvent;
use App\Event\PropertyDeletedEvent;
use App\Event\PropertyStatusChangedEvent;
use App\Event\PropertyUpdatedEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class PropertyEventDispatchingService
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatchPropertyCreatedEvent($property): void
    {
        $this->eventDispatcher->dispatch(new PropertyCreatedEvent($property), PropertyCreatedEvent::NAME);
    }

    public function dispatchPropertyUpdatedEvent($property): void
    {
        $this->eventDispatcher->dispatch(new PropertyUpdatedEvent($property), PropertyUpdatedEvent::NAME);
    }

    public function dispatchPropertyDeletedEvent($propertyTitle): void
    {
        $this->eventDispatcher->dispatch(new PropertyDeletedEvent($propertyTitle), PropertyDeletedEvent::NAME);
    }

    public function dispatchPropertyStatusChangedEvent($originalProperty, $updatedProperty): void
    {
        $this->eventDispatcher->dispatch(new PropertyStatusChangedEvent($originalProperty, $updatedProperty), PropertyStatusChangedEvent::NAME);
    }
}