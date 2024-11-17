<?php

namespace App\Controller;

use App\Entity\Property;
use App\Service\PropertyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/property')]
class PropertyController extends AbstractController
{
    private PropertyService $propertyService;
    private Request $request;

    public function __construct(
        PropertyService $propertyService,
        RequestStack $requestStack
    )
    {
        $this->propertyService = $propertyService;
        $this->request = $requestStack->getCurrentRequest();
    }

    #[Route('/', name: 'property_get_all', methods: ["GET"])]
    public function getAll(): JsonResponse
    {
        $properties = $this->propertyService->getAllProperties();

        return $this->json($properties);
    }

    #[Route('/{id}', name: 'property_get', methods: ["GET"])]
    public function get(int $id): JsonResponse
    {
        $property = $this->propertyService->getPropertyById($id);

        if(!$property) {
            return $this->json([], Response::HTTP_NOT_FOUND);
        }

        return $this->json($property);
    }

    #[Route('/{id}', name: 'property_delete', methods: ["DELETE"])]
    public function delete(int $id): JsonResponse
    {
        $property = $this->propertyService->getPropertyById($id);

        if(!$property) {
            return $this->json([], Response::HTTP_NOT_FOUND);
        }

        $this->propertyService->deleteProperty($property);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
