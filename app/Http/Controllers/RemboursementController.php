<?php

namespace App\Http\Controllers;

use App\Assurance;
use Illuminate\Http\Request;
use App\Remboursement;
use App\Objet;

class RemboursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aa = [];
        foreach (Remboursement::get() as $a) {
            if ($a->assurance && $a->assurance->id) {
                $bb = Assurance::find($a->assurance->id);
                $rules = [
                    'id' => $a->id,
                    'objet' => $bb->objets['nom'],
                    'DateR' => $a->DateR,
                    'Reponse' => $a->Reponse
                ];
                array_push($aa, $rules);
            }
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
        //   $remboursement=Remboursement::create($request->all());
        //  return response()->json($remboursement, 200);
        $remboursement = new Remboursement;
        $objet = new Objet;
        $user = $request->user();

        $objet->nom = $request->name;
        $remboursement->Etat = $request->etat;
        $remboursement->id_client = $user->id;

        $result = $remboursement->save();
        $result2 = $objet->save();


        if ($result && $result2) {

            return ["Result" => ["Remboursement" => $remboursement, "Objet" => $objet]];
        } else {
            return ["Result" => "Data has not been saved"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Remboursement::find($id), 201);
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
    public function update(Request $request, $remboursement)
    {
        $remboursement->update($request->all());
        return response()->json($remboursement, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remboursement $remboursement)
    {
        $remboursement->delete();
        return response()->json(null, 204);
    }
}
