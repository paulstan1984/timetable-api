<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Services\ReservationRepository;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    var $repository;
    var $paginationService;

    public function __construct(ReservationRepository $repository, PaginationService $paginationService)
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
    
    public function search($page = 1, $keyword = null, $start_time = null, $end_time = null)
    {
        $query = $this->repository->search($keyword, $start_time, $end_time);
        $query = $query->orderBy('start_time', 'desc');

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
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|max:100',
            'client_phone' => 'required|max:10',
            'client_email' => 'required|max:200|email',
            'start_time' => 'required|date|after_or_equal:tomorrow',
            'schedule_unit' => 'required|integer|gte:1',
            'phisical_resource_id' => ['required','integer', Rule::exists('phisical_resources', 'id')],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $item = $this->repository->create($validator->validated());

        return response()->json($item, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Reservation::find($id);

        if ($item == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        return response()->json($item, 200);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Reservation::find($id);

        if ($item == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'client_name' => 'required|max:100',
            'client_phone' => 'required|max:10',
            'client_email' => 'required|max:200|email',
            'start_time' => 'required|date|after_or_equal:tomorrow',
            'schedule_unit' => 'required|integer|gte:1',
            'phisical_resource_id' => ['required','integer', Rule::exists('phisical_resources', 'id')],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $this->repository->update($item, $validator->validated());

        return response()->json(Reservation::find($item->id), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Reservation::find($id);

        if ($item == null) {
            return response()->json(['error' => 'not found'], 400);
        }

        $this->repository->delete($item);

        return response()->json(true, 200);
    }
}
