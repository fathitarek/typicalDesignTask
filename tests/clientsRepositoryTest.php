<?php

use App\Models\clients;
use App\Repositories\clientsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class clientsRepositoryTest extends TestCase
{
    use MakeclientsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var clientsRepository
     */
    protected $clientsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->clientsRepo = App::make(clientsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateclients()
    {
        $clients = $this->fakeclientsData();
        $createdclients = $this->clientsRepo->create($clients);
        $createdclients = $createdclients->toArray();
        $this->assertArrayHasKey('id', $createdclients);
        $this->assertNotNull($createdclients['id'], 'Created clients must have id specified');
        $this->assertNotNull(clients::find($createdclients['id']), 'clients with given id must be in DB');
        $this->assertModelData($clients, $createdclients);
    }

    /**
     * @test read
     */
    public function testReadclients()
    {
        $clients = $this->makeclients();
        $dbclients = $this->clientsRepo->find($clients->id);
        $dbclients = $dbclients->toArray();
        $this->assertModelData($clients->toArray(), $dbclients);
    }

    /**
     * @test update
     */
    public function testUpdateclients()
    {
        $clients = $this->makeclients();
        $fakeclients = $this->fakeclientsData();
        $updatedclients = $this->clientsRepo->update($fakeclients, $clients->id);
        $this->assertModelData($fakeclients, $updatedclients->toArray());
        $dbclients = $this->clientsRepo->find($clients->id);
        $this->assertModelData($fakeclients, $dbclients->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteclients()
    {
        $clients = $this->makeclients();
        $resp = $this->clientsRepo->delete($clients->id);
        $this->assertTrue($resp);
        $this->assertNull(clients::find($clients->id), 'clients should not exist in DB');
    }
}
