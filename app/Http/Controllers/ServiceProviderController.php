<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use App\Services\ServiceProviderRepository;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Validator;

class ServiceProviderController extends Controller
{

    var $serviceProviderRepository;
    var $paginationService;

    public function __construct(ServiceProviderRepository $serviceProviderRepository, PaginationService $paginationService) {
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
        //
    }

    public function search($keyword = null)
    {
        $query = $this->serviceProviderRepository->search($keyword);
        $query = $query->orderBy('name', 'asc');

        $pagination = $this->paginationService->applyPagination($query, 1);

        return $pagination;
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
            'email' => 'required|unique:service_providers|max:200',
        ]);

        if($validator->fails()){
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
    public function show(ServiceProvider $serviceProvider)
    {
        return $serviceProvider;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
    }
}
