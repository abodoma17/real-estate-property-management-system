<?php

namespace App\EventListener;

use App\Event\PropertyUpdatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class PropertyUpdatedEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[AsEventListener(event: PropertyUpdatedEvent::NAME)]
    public function onPropertyUpdated(PropertyUpdatedEvent $event): void
    {
        $this->logger->info("[PROPERTY UPDATED] {$event->getProperty()->getTitle()} has been updated.");
    }
}
