<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class clientsApiTest extends TestCase
{
    use MakeclientsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateclients()
    {
        $clients = $this->fakeclientsData();
        $this->json('POST', '/api/v1/clients', $clients);

        $this->assertApiResponse($clients);
    }

    /**
     * @test
     */
    public function testReadclients()
    {
        $clients = $this->makeclients();
        $this->json('GET', '/api/v1/clients/'.$clients->id);

        $this->assertApiResponse($clients->toArray());
    }

    /**
     * @test
     */
    public function testUpdateclients()
    {
        $clients = $this->makeclients();
        $editedclients = $this->fakeclientsData();

        $this->json('PUT', '/api/v1/clients/'.$clients->id, $editedclients);

        $this->assertApiResponse($editedclients);
    }

    /**
     * @test
     */
    public function testDeleteclients()
    {
        $clients = $this->makeclients();
        $this->json('DELETE', '/api/v1/clients/'.$clients->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/clients/'.$clients->id);

        $this->assertResponseStatus(404);
    }
}
