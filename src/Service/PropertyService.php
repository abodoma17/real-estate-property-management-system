<?php

namespace App\Service;

use App\Entity\Property;
use App\Event\PropertyCreatedEvent;
use App\Event\PropertyDeletedEvent;
use App\Event\PropertyStatusChangedEvent;
use App\Event\PropertyUpdatedEvent;
use App\Repository\PropertyRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class PropertyService
{
    private EntityManagerInterface $entityManager;
    private PropertyRepository $propertyRepository;
    private PropertyEventDispatchingService $propertyEventDispatchingService;

    public function __construct(
        EntityManagerInterface $entityManager,
        PropertyRepository $propertyRepository,
        PropertyEventDispatchingService $propertyEventDispatchingService
    )
    {
        $this->entityManager = $entityManager;
        $this->propertyRepository = $propertyRepository;
        $this->propertyEventDispatchingService = $propertyEventDispatchingService;
    }

    public function getAllProperties(): Array
    {
        return $this->propertyRepository->findAll();
    }

    public function getPropertyById(int $id): ?Property
    {
        if(!$id) {
            return null;
        }

        return $this->propertyRepository->find($id);
    }

    public function deleteProperty(Property $property): void
    {
        $propertyTitle = $property->getTitle();

        $this->entityManager->remove($property);
        $this->entityManager->flush();

        $this->propertyEventDispatchingService->dispatchPropertyDeletedEvent($propertyTitle);
    }

    public function createProperty(Property $property): ?Property
    {
        $property->setCreatedAt(new DateTimeImmutable());
        $this->entityManager->persist($property);
        $this->entityManager->flush();

        $this->propertyEventDispatchingService->dispatchPropertyCreatedEvent($property);

        return $property;
    }

    public function updateProperty(Property $originalProperty, Property $updatedProperty): Property
    {
        $this->entityManager->flush();

        $this->propertyEventDispatchingService->dispatchPropertyUpdatedEvent($updatedProperty);

        if($originalProperty->getStatus() !== $updatedProperty->getStatus()) {
            $this->propertyEventDispatchingService->dispatchPropertyStatusChangedEvent($originalProperty, $updatedProperty);
        }

        return $updatedProperty;
    }
}