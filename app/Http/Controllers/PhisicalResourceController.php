<?php

namespace App\Http\Controllers;

use App\Models\PhisicalResource;
use Illuminate\Http\Request;
use App\Services\PhisicalResourceRepository;
use App\Services\PaginationService;

class PhisicalResourceController extends Controller
{
    var $repository;
    var $paginationService;

    public function __construct(PhisicalResourceRepository $repository, PaginationService $paginationService)
    {
        $this->repository = $repository;
        $this->paginationService = $paginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->search();
    }

    public function search($page = 1, $keyword = null)
    {
        $query = $this->repository->search($keyword);
        $query = $query->orderBy('name', 'asc');

        $pagination = $this->paginationService->applyPagination($query, $page);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhisicalResource  $phisicalResource
     * @return \Illuminate\Http\Response
     */
    public function show(PhisicalResource $phisicalResource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhisicalResource  $phisicalResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhisicalResource $phisicalResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhisicalResource  $phisicalResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhisicalResource $phisicalResource)
    {
        //
    }
}
