<?php

namespace App\EventListener;

use App\Event\PropertyCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class PropertyCreatedEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[AsEventListener(event: PropertyCreatedEvent::NAME)]
    public function onPropertyCreated(PropertyCreatedEvent $event): void
    {
        $property = $event->getProperty();
        
        $this->logger->info("[PROPERTY CREATED] Property {$property->getTitle()} created at {$property->getCreatedAt()->format('Y/m/d H:i:s')}");
    }
}
