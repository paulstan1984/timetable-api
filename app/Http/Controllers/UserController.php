<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\UserRepository;
use App\Services\PaginationService;

class UserController extends Controller
{
    var $repository;
    var $paginationService;

    public function __construct(UserRepository $repository, PaginationService $paginationService)
    {
        $this->repository = $repository;
        $this->paginationService = $paginationService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $item = $validator->validated();
        $token = $this->repository->login($item);

        return response()->json($token, 200);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $item = $validator->validated();
        $token = $this->repository->logout($item['token']);

        return response()->json($token, 200);
    }

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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
