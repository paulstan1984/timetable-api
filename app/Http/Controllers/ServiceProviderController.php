<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use App\Services\ServiceProviderRepository;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

class ServiceProviderController extends Controller
{

    var $serviceProviderRepository;
    var $paginationService;

    public function __construct(ServiceProviderRepository $serviceProviderRepository, PaginationService $paginationService)
    {
        $this->serviceProviderRepository = $serviceProviderRepository;
        $this->paginationService = $paginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/service-providers",
     *     tags={"ServiceProvider"},
     *     summary="demo swagger documentation: returns information about service providers",
     *     description="returns an array of service providers",
     *     operationId="searchServiceProviders",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */
    public function index()
    {
        return $this->search();
    }

    public function search($page = 1, $keyword = null, User $user)
    {
        return response()->json($user);
        
        $query = $this->serviceProviderRepository->search($keyword);
        $query = $query->orderBy('name', 'asc');

        $pagination = $this->paginationService->applyPagination($query, $page);

        return $pagination;
    }

    public function get_phisical_resources(int $provider_id)
    {
        $serviceProvider = ServiceProvider::find($provider_id);

        if ($serviceProvider == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        $resources = $serviceProvider->phisical_resources()->get();

        return response()->json($resources, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:service_providers|max:100',
            'phone' => 'required|max:10',
            'email' => 'required|unique:service_providers|max:200|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $item = $this->serviceProviderRepository->create($validator->validated());

        return response()->json($item, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function show(int $Id)
    {
        $serviceProvider = ServiceProvider::find($Id);

        if ($serviceProvider == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        return response()->json($serviceProvider, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $Id)
    {
        $serviceProvider = ServiceProvider::find($Id);

        if ($serviceProvider == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:100', Rule::unique('service_providers')->ignore($serviceProvider->id)],
            'phone' => 'required|max:10',
            'email' => ['required', 'email', 'max:200', Rule::unique('service_providers')->ignore($serviceProvider->id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $this->serviceProviderRepository->update($serviceProvider, $validator->validated());

        return response()->json(ServiceProvider::find($serviceProvider->id), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $Id)
    {
        $serviceProvider = ServiceProvider::find($Id);

        if ($serviceProvider == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        $this->serviceProviderRepository->delete($serviceProvider);

        return response()->json(true, 200);
    }
}
