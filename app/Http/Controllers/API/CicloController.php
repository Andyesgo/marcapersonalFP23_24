<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CicloResource;
use App\Models\Ciclo;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    public $modelclass = Ciclo::class;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CicloResource::collection(
            Ciclo::orderBy($request->_sort, $request->_order)
            ->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ciclo = json_decode($request->getContent(), true);

        $ciclo = Ciclo::create($ciclo['data']['attributes']);

        return new CicloResource($ciclo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ciclo $ciclo)
    {
        return new CicloResource($ciclo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ciclo $ciclo)
    {
        $cicloData = json_decode($request->getContent(), true);
        $ciclo->update($cicloData['data']['attributes']);

        return new CicloResource($ciclo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ciclo $ciclo)
    {
        $ciclo->delete();
    }
}