<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Td;
class TdController extends Controller
{
    public function index()
    {
        return response()->json(Td::get(), 200);
    }

 
    public function store(Request $request)
    {
        $cour=Td::create($request->all());
        return response()->json($cour, 200);
    }

    public function show($id)
    {
        return response()->json(Client::find($id), 201);
    }

    public function update(Request $request, Td $cour)
    {
        $cour->update($request->all());
        return response()->json($cour, 200);

    }

  
    public function destroy(Td $cour)
    {
        $cour->delete();
        return response()->json(null,204);
    }
}
