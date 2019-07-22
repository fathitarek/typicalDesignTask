<?php

namespace App\Repositories;

use App\Models\clients;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class clientsRepository
 * @package App\Repositories
 * @version July 22, 2019, 10:50 am UTC
 *
 * @method clients findWithoutFail($id, $columns = ['*'])
 * @method clients find($id, $columns = ['*'])
 * @method clients first($columns = ['*'])
*/
class clientsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'latitude',
        'longitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return clients::class;
    }
}
