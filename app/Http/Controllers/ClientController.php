<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Hash;

class clientController extends Controller
{
    /* function addData(Request $request){
        $client = new Client;
        $client->nom=$request->firstName;
        $client->prenom=$request->lastName;
        $client->numCIN=$request->nicNumber;
        $client->numTel=$request->mobilePhone;
        $client->email=$request->email;
        $client->password=$request->password;
        $client->photo=$request->photo;
        $client->save();
        return redirect('/'); 
    } */



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request)
    {
        //  return response()->json(client::get(), 200);
        $client = new Client;

        $client = client::where('email', $request->email)->first();
        // print_r($data);
        if (!$client || !Hash::check($request->password, $client->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $client->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $client,
            'token' => $token
        ];

        return response($response, 201);
    }
    function create(Request $request)
    {
        if (!$request['nom'] || !$request['email'] || !$request['password']) {
            return response([
                'message' => ['Missing information!']
            ], 404);
        }
        $client = client::where('email', $request->email)->first();
        if ($client) {
            return response([
                'message' => ['Email existe deja']
            ], 404);
        }

        $client = Client::create([
            'nom' => $request['nom'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $token = $client->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $client,
            'token' => $token
        ];

        return response($response, 201);
        //   $client= client::where('email', $request->email)->first();
        //   // print_r($data);
        //       if (!$client || !Hash::check($request->numCIN, $client->numCIN)) {
        //           return response([
        //               'message' => ['Sign Up not successful!']
        //           ], 404);
        //       }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(Request $request)
    {
        //    $client = client::create($request->all());
        $user = $request->user();
        if (!$user) {
            return response()->json([], 401);
        }
        $client = client::where('id', $user->id)->first();
        if (!$client) {
            return response()->json([], 401);
        }
        if ($request->lastName) $client->nom = $request->lastName;
        if ($request->firstName) $client->prenom = $request->firstName;
        if ($request->cinNumber) $client->numCIN = $request->cinNumber;
        if ($request->mobilePhone) $client->numTel = $request->mobilePhone;
        if ($request->email) $client->email = $request->email;
        if ($request->password) $client->password = Hash::make($request->password);
        if ($request->photo) $client->photo = $request->photo;
        $client->save();

        return response()->json($client, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function get(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([], 401);
        }

        return response()->json(client::find($user->id), 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function show($id)
    {
        return response()->json(client::find($id), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function edit($id)
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
    function update(Request $request, $client)
    {
        $client->update($request->all());
        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy(client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}
