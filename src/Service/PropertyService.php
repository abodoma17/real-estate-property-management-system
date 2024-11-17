<?php

namespace App\Service;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Array_;

class PropertyService
{
    private EntityManagerInterface $entityManager;
    private PropertyRepository $propertyRepository;

    public function __construct(EntityManagerInterface $entityManager, PropertyRepository $propertyRepository)
    {
        $this->entityManager = $entityManager;
        $this->propertyRepository = $propertyRepository;
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
}