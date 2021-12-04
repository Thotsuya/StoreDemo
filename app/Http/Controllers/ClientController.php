<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Clients/Index',[
            'clients' => Client::latest('id')->paginate(10)
        ]);
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
        $client = $request->validate([
            'name' => 'required',
            'credit_limit' => 'required|numeric|max:3000000'
        ],[
            'credit_limit.required' => 'El límite de crédito es requerido',
            'credit_limit.max' => 'El límite de crédito  no debe ser mayor que 3,000,000.'
        ]);

        Client::create($client);

        return redirect()->route('clients.index')->with('message', 'Cliente registrado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit',[
            'client' => $client->load('addresses')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $updatedClient = $request->validate([
            'name' => 'required',
            'credit_limit' => 'required|numeric|max:3000000'
        ],[
            'credit_limit.required' => 'El límite de crédito es requerido',
            'credit_limit.max' => 'El límite de crédito  no debe ser mayor que 3,000,000.'
        ]);

        $client->update($updatedClient);

        return redirect()->route('clients.edit',$client)->with('message', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
       $client->delete();
       return redirect()->route('clients.index')->with('message', 'Cliente Eliminado exitosamente.');
    }
}
