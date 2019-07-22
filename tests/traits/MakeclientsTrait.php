<?php

use Faker\Factory as Faker;
use App\Models\clients;
use App\Repositories\clientsRepository;

trait MakeclientsTrait
{
    /**
     * Create fake instance of clients and save it in database
     *
     * @param array $clientsFields
     * @return clients
     */
    public function makeclients($clientsFields = [])
    {
        /** @var clientsRepository $clientsRepo */
        $clientsRepo = App::make(clientsRepository::class);
        $theme = $this->fakeclientsData($clientsFields);
        return $clientsRepo->create($theme);
    }

    /**
     * Get fake instance of clients
     *
     * @param array $clientsFields
     * @return clients
     */
    public function fakeclients($clientsFields = [])
    {
        return new clients($this->fakeclientsData($clientsFields));
    }

    /**
     * Get fake data of clients
     *
     * @param array $postFields
     * @return array
     */
    public function fakeclientsData($clientsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'address' => $fake->word,
            'latitude' => $fake->word,
            'longitude' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $clientsFields);
    }
}
