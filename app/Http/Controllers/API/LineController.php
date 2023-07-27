<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LineUpFormRequest;
use App\Http\Resources\LineResource;
use App\Services\LineService;
use Illuminate\Http\Request;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LineService $line)
    {
        $lines = $line->all();

        return response()->json(LineResource::collection($lines));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LineUpFormRequest $request, LineService $line)
    {
        $new_line_up = $line->add($request);
        return response()->json($new_line_up, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LineUpFormRequest $request, $id, LineService $lineService)
    {
        $new_line_up = $lineService->update($id, $request);
        return response()->json($new_line_up, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, LineService $lineService)
    {
        $lineService->delete($id);
        return response()->json('Success', 201);
    }
}
