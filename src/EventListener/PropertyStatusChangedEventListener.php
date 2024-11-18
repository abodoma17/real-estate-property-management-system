<?php

namespace App\EventListener;

use App\Event\PropertyStatusChangedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class PropertyStatusChangedEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[AsEventListener(event: PropertyStatusChangedEvent::NAME)]
    public function onPropertyStatusChanged(PropertyStatusChangedEvent $event): void
    {
        $oldProperty = $event->getOldProperty();
        $updatedProperty = $event->getUpdatedProperty();

        $this->logger->info("[PROPERTY STATUS CHANGED] {$updatedProperty->getTitle()} status was changed from {$oldProperty->getStatus()} to {$updatedProperty->getStatus()}");
    }
}
