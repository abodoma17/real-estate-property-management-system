<?php

namespace App\Tests;

use App\Enums\PropertyStatusEnum;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PropertyControllerTest extends WebTestCase
{
    private static $client;

    public static function setUpBeforeClass(): void
    {
        self::ensureKernelShutdown();
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::$client = static::createClient([
            'environment' => 'test',
            'debug' => false,
        ]);
    }

    public function testInvalidCreateProperty()
    {
        $payload = [
            "title" => "Test POST Property",
            "description" => "Test description",
            "price" => -500,
            "status" => "INVALID_TEST_VALUE",
            "location" => "Test, Location"
        ];

        self::$client->request(
            "POST",
            "/api/v1/property/",
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode($payload)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testCreateProperty()
    {
        $payload = [
            "title" => "Test POST Property Success",
            "description" => "Test description",
            "price" => 500,
            "status" => PropertyStatusEnum::APPROVED->value,
            "location" => "Test, Location"
        ];

        self::$client->request(
            "POST",
            "/api/v1/property/",
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $data = json_decode(self::$client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $data);

        return $data;
    }

    /**
     * @depends testCreateProperty
     */
    public function testGetProperty(array $propertyData)
    {
        self::$client->request(
            "GET",
            "/api/v1/property/{$propertyData['id']}",
            [],
            []
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @depends testCreateProperty
     */
    public function testInvalidUpdateProperty(array $propertyData)
    {
        $payload = [
            "title" => "Test PUT Property Success",
            "description" => "Test description",
            "price" => -500,
            "status" => "INVALID_VALUE",
            "location" => "Test, Location"
        ];

        self::$client->request(
            "PUT",
            "/api/v1/property/{$propertyData['id']}",
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @depends testCreateProperty
     */
    public function testUpdateProperty(array $propertyData)
    {
        $payload = [
            "title" => "Test PUT Property Success",
            "description" => "Test description",
            "price" => 500,
            "status" => PropertyStatusEnum::APPROVED->value,
            "location" => "Test, Location"
        ];

        self::$client->request(
            "PUT",
            "/api/v1/property/{$propertyData['id']}",
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        return $propertyData['id'];
    }

    /**
     * @depends testUpdateProperty
     */
    public function testDeleteProperty($propertyId)
    {
        self::$client->request(
            "DELETE",
            "/api/v1/property/$propertyId",
            [],
            []
        );

        $this->assertResponseIsSuccessful();
    }
}
