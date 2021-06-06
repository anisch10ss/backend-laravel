<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cour;

class CourController extends Controller
{
 
    public function index()
    {
        return response()->json(Cour::get(), 200);
    }

 
    public function store(Request $request)
    {
        $cour=Cour::create($request->all());
        return response()->json($cour, 200);
    }

    public function show($id)
    {
        return response()->json(Cour::find($id), 201);
    }

    public function update(Request $request, Cour $cour)
    {
        $cour->update($request->all());
        return response()->json($cour, 200);

    }

  
    public function destroy(Cour $cour)
    {
        $cour->delete();
        return response()->json(null,204);
    }
}
