<?php

namespace App\Http\Controllers;

use App\Models\PhisicalResource;
use App\Http\Requests\StorePhisicalResourceRequest;
use App\Http\Requests\UpdatePhisicalResourceRequest;

class PhisicalResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhisicalResourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhisicalResourceRequest $request)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhisicalResource  $phisicalResource
     * @return \Illuminate\Http\Response
     */
    public function edit(PhisicalResource $phisicalResource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhisicalResourceRequest  $request
     * @param  \App\Models\PhisicalResource  $phisicalResource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhisicalResourceRequest $request, PhisicalResource $phisicalResource)
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
