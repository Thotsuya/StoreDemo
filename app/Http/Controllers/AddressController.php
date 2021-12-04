<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request){

        $address = $request->validate([
            'address' => 'required',
            'street' => 'required',
            'city' => 'required',
            'district' => 'required',
            'client_id' => 'required|exists:App\Models\Client,id'
        ],[
            'street.required' => 'El campo calle es obligatorio.',
            'district.required' => 'El campo distrito es obligatorio.'
        ]);

        $client = Client::findOrFail($request->client_id);
        $client->addresses()->create($address);

        return redirect()->route('clients.edit',$client)->with('message', 'Dirección registrada exitosamente.');

    }

    public function destroy(Address $address){

        $address->delete();
        return redirect()->back()->with('message', 'Dirección eliminada exitosamente.');
    }
}
