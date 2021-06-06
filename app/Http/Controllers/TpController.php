<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tp;
class TpController extends Controller
{
    public function index()
    {
        return response()->json(Tp::get(), 200);
    }

 
    public function store(Request $request)
    {
        $cour=Tp::create($request->all());
        return response()->json($cour, 200);
    }

    public function show($id)
    {
        return response()->json(Tp::find($id), 201);
    }

    public function update(Request $request, Tp $cour)
    {
        $cour->update($request->all());
        return response()->json($cour, 200);

    }

  
    public function destroy(Tp $cour)
    {
        $cour->delete();
        return response()->json(null,204);
    }
}
