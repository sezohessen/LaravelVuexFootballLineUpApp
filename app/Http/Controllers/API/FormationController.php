<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormationResource;
use App\Http\Resources\PlayerResource;
use App\Services\FormationService;
use App\Services\PlayerService;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FormationService $form)
    {
        $forms = $form->all();
        /* dd($form->all()->last()); */
        return response()->json(FormationResource::collection($forms));
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
    public function store(Request $request,FormationService $form)
    {
        return $form->store($request);

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FormationService $formationService)
    {
        $formationService->delete($id);
        return response()->json('Success', 201);
    }
    public function goalkeepers(PlayerService $form)
    {
        $forms = $form->goalkeepers();
        return response()->json(PlayerResource::collection($forms));
    }
    public function defenders(PlayerService $form)
    {
        $forms = $form->defenders();
        return response()->json(PlayerResource::collection($forms));
    }
    public function midfielders(PlayerService $form)
    {
        $forms = $form->midfielders();
        return response()->json(PlayerResource::collection($forms));
    }
    public function attackers(PlayerService $form)
    {
        $forms = $form->attackers();
        return response()->json(PlayerResource::collection($forms));
    }
}
