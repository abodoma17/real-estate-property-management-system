<?php

namespace App\EventListener;

use App\Event\PropertyDeletedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class PropertyDeletedEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[AsEventListener(event: PropertyDeletedEvent::NAME)]
    public function onPropertyDeleted(PropertyDeletedEvent $event): void
    {
        $this->logger->info("[PROPERTY DELETED]: {$event->getPropertyTitle()} has been deleted.");
    }
}
