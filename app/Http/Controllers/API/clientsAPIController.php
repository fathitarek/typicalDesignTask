<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateclientsAPIRequest;
use App\Http\Requests\API\UpdateclientsAPIRequest;
use App\Models\clients;
use App\Repositories\clientsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class clientsController
 * @package App\Http\Controllers\API
 */

class clientsAPIController extends AppBaseController
{
    /** @var  clientsRepository */
    private $clientsRepository;

    public function __construct(clientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
    }

    /**
     * Display a listing of the clients.
     * GET|HEAD /clients
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clientsRepository->pushCriteria(new RequestCriteria($request));
        $this->clientsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $clients = $this->clientsRepository->all();

        return $this->sendResponse($clients->toArray(), 'Clients retrieved successfully');
    }

    /**
     * Store a newly created clients in storage.
     * POST /clients
     *
     * @param CreateclientsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateclientsAPIRequest $request)
    {
        $input = $request->all();

        $clients = $this->clientsRepository->create($input);

        return $this->sendResponse($clients->toArray(), 'Clients saved successfully');
    }

    /**
     * Display the specified clients.
     * GET|HEAD /clients/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var clients $clients */
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            return $this->sendError('Clients not found');
        }

        return $this->sendResponse($clients->toArray(), 'Clients retrieved successfully');
    }

    /**
     * Update the specified clients in storage.
     * PUT/PATCH /clients/{id}
     *
     * @param  int $id
     * @param UpdateclientsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclientsAPIRequest $request)
    {
        $input = $request->all();

        /** @var clients $clients */
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            return $this->sendError('Clients not found');
        }

        $clients = $this->clientsRepository->update($input, $id);

        return $this->sendResponse($clients->toArray(), 'clients updated successfully');
    }

    /**
     * Remove the specified clients from storage.
     * DELETE /clients/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var clients $clients */
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            return $this->sendError('Clients not found');
        }

        $clients->delete();

        return $this->sendResponse($id, 'Clients deleted successfully');
    }
}
