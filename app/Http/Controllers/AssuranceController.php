<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assurance;
class AssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $aa=[];
       foreach(Assurance::get() as $a)
       {
        $rules = [
            'id' => $a->id,
            'objet' =>$a->objets->nom,
            'Pack' =>$a->Pack,
            'Date_debut' =>$a->Date_debut,
            'Date_fin'=>$a->Date_fin,
            'Etat_demande'=>$a->Etat_demande

        ];
        array_push($aa,$rules);
        
       }
       return response()->json($aa, 200);


    }
    public function index2()
    {
       $aa=[];
       foreach(Assurance::get() as $a)
       {
        $rules = [
            'objet' =>$a->objets->nom,
            'Type'=> $a->Type,
            'Etat_demande'=>$a->Etat_demande,
            'Pack' =>$a->Pack,

        ];
        array_push($aa,$rules);
        
       }
       return response()->json($aa, 200);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assurance=Assurance::create($request->all());
        return response()->json($assurance, 200);    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Assurance::find($id), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assurance)
    {
        $assurance->update($request->all());
        return response()->json($assurance, 200);   
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assurance $assurance)
    {
        $assurance->delete();
        return response()->json(null,204);    }
}

