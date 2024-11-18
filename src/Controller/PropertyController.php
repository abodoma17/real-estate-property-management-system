<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Service\FormErrorFormatter;
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
    private FormErrorFormatter $formErrorFormatter;

    public function __construct(
        PropertyService $propertyService,
        RequestStack $requestStack,
        FormErrorFormatter $formErrorFormatter
    )
    {
        $this->propertyService = $propertyService;
        $this->request = $requestStack->getCurrentRequest();
        $this->formErrorFormatter = $formErrorFormatter;
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

    #[Route('/', name: 'property_create', methods: ["POST"])]
    public function create(): JsonResponse
    {
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property);
        $form->submit($this->request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $property = $this->propertyService->createProperty($property);
            return $this->json($property);
        }

        return $this->json([
                'errors' => $this->formErrorFormatter->getErrorMessages($form)
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    #[Route('/{id}', name: 'property_update', methods: ["PATCH", "PUT"])]
    public function update(int $id): JsonResponse
    {
        $property = $this->propertyService->getPropertyById($id);

        if(!$property) {
            return $this->json([], Response::HTTP_NOT_FOUND);
        }

        $originalProperty = clone $property;

        $form = $this->createForm(PropertyType::class, $property);
        $form->submit($this->request->request->all(), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $property = $this->propertyService->updateProperty($originalProperty, $property);
            return $this->json($property);
        }

        return $this->json([
            'errors' => $this->formErrorFormatter->getErrorMessages($form)
        ],
            Response::HTTP_BAD_REQUEST
        );
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
