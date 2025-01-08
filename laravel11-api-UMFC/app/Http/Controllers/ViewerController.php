<?php

namespace App\Http\Controllers;

use App\Models\Viewer;
use Illuminate\Http\Request;

class ViewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $viewer = Viewer::paginate(10);
        return response()->json([
            'data'=> $viewer
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $viewer = Viewer::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_number' => $request->id_number,
            'age' => $request->age
        ]);
        return response()->json([
            'data' => $viewer
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Viewer $viewer)
    {
        //
        return response()->json([
            'data' => $viewer
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Viewer $viewer)
    {
        //
        $viewer->name = $request->name;
        $viewer->email = $request->email;
        $viewer->id_number = $request->id_number;
        $viewer->age = $request->age;
        $viewer->save();

        return response()->json([
            'data' => $viewer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viewer $viewer)
    {
        //
        $viewer->delete();
        return response()->json([
            'message' => 'viewer deleted'
        ], 204);
    }
}
