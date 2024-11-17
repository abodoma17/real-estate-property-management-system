<?php

namespace App\Controller;

use App\Service\PropertyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/property')]
class PropertyController extends AbstractController
{
    private PropertyService $propertyService;
    private Request $request;

    public function __construct(PropertyService $propertyService, RequestStack $requestStack)
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
}
