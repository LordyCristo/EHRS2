<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollegeRequest;
use App\Http\Resources\CollegeCollection;
use App\Http\Resources\CollegeResource;
use App\Models\College;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class CollegeApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): CollegeCollection
    {
        return new CollegeCollection(College::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollegeRequest $request)
    {
        $newCollege = College::create($request->all());
        return (new CollegeResource($newCollege))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(College $college)
    {
        return new CollegeResource($college);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        $update = $college->update($request->all());
        if ($update)
            return response(null, 202);
        return  response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college): JsonResponse
    {
        $college = College::findOrFail($college->id);
        $college->delete();
        // return the success code
        return response()->json([
            'success' => true,
            'message' => 'College deleted successfully'
        ]);
    }


    /**
     * Get all the colleges to be displayed in the datatable, that can handle the search, pagination, and sorting.
     */
    public function tableApi(Request $request): JsonResponse
    {
        $query = College::select(['id', 'name', 'abbr', 'is_active']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by', 'id');
            $query->where(function ($q) use ($search, $searchBy) {
                if ($searchBy == '*') {
                    $q->where('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('abbr', 'like', '%' . $search . '%')
                        ->orWhere('is_active', 'like', '%' . $search . '%');
                } else {
                    $q->where('colleges.' . $searchBy, 'like', '%' . $search . '%');
                }
            });
        }

        // Handle sorting
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('sort_dir', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            //get the total number of pages
            'totalPages' => $paginator->lastPage(),
            'hasMorePage' => $paginator->hasMorePages(),
            'totalCount' => $paginator->total(),
            'data' => $paginator->items(),
            'perPage' => $paginator->perPage(),
            'pageCount' => $paginator->perPage(),
            'prevPage' => $paginator->lastPage(),
            'currPage' => $paginator->currentPage(),
            'nextPage' => $paginator->nextPageUrl(),
        ]);
    }

}
