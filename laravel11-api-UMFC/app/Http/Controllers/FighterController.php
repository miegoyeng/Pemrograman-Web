<?php

namespace App\Http\Controllers;

use App\Models\Fighter;
use App\Http\Resources\FighterResource;
use Illuminate\Http\Request;



class FighterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fighter = Fighter::latest()->paginate(5);

        return new FighterResource(true, 'List Data Fighter', $fighter);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fighter = Fighter::create([
            'name' => $request->name,
            'weight_class' => $request->weight_class,
            'record' => $request->record,
            'region' => $request->region
        ]);

        return new FighterResource(true, 'Data Post Fighter has been added', $fighter);
    }

    /**
     * Display the specified resource.
     */
     
    /** 
     * show 
     * 
     * @param  mixed $id 
     * @return void 
     */ 
    public function show($id): FighterResource
    {
        $fighter = Fighter::find($id);

        return new FighterResource(true, 'Detail Data Fighter', $fighter);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fighter $fighter)
    {
        //
        $fighter->update([
            'name' => $request->name,
            'weight_class' => $request->weight_class,
            'record' => $request->record,
            'region' => $request->region,
        ]);

        return new FighterResource(true, 'Data Fighter has been updated', $fighter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fighter = Fighter::find($id);

        $fighter->delete();

        return new FighterResource(true, 'Data Fighter has been deleted', null);
    }
}
