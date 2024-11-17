<?php

namespace App\Service;

use App\Entity\Property;
use App\Event\PropertyDeletedEvent;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class PropertyService
{
    private EntityManagerInterface $entityManager;
    private PropertyRepository $propertyRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        PropertyRepository $propertyRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->entityManager = $entityManager;
        $this->propertyRepository = $propertyRepository;
        $this->eventDispatcher = $eventDispatcher;
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

//        $this->entityManager->remove($property);
//        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(new PropertyDeletedEvent($propertyTitle), PropertyDeletedEvent::NAME);
    }
}