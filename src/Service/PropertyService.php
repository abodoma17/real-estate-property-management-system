<?php

namespace App\Service;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;

class PropertyService
{
    private EntityManagerInterface $entityManager;
    private PropertyRepository $propertyRepository;

    public function __construct(EntityManagerInterface $entityManager, PropertyRepository $propertyRepository)
    {
        $this->entityManager = $entityManager;
        $this->propertyRepository = $propertyRepository;
    }

    public function getAllProperties()
    {
        return $this->propertyRepository->findAll();
    }
}