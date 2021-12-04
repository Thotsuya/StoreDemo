<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Orders/Index',[
            'orders' => Order::with(['client','address'])
                               ->latest('id')
                               ->paginate(10),
            'clients' => Client::latest()->get(),
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
            'client_id' => 'required'
        ]);

        $order = Order::create($client);
        return redirect()->route('orders.edit',$order)->withMessage('Orden Generada con éxito');

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
    public function edit(Order $order)
    {
        return Inertia::render('Orders/Edit',[
            'order' => $order->load('client')
                                ->load('products'),
            'addresses' => $order->client->addresses,
            'products' => Product::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $updatedOrder = $request->validate([
            'address_id' => 'required',
            'products' => 'required',
            'products.*.product_id' => 'required',
            'products.*.amount' => 'required_with:products.*.product_id'
        ]);

        $order->update([
            'address_id' => $updatedOrder['address_id']
        ]);

        if($request->products){

            $order->products()->detach();

            for($i=0;$i<count($request->products);$i++){

                $order->products()->attach($request->products[$i]['product_id'],[
                    'amount' => $request->products[$i]['amount']
                ]);

            }
        }

        return redirect()->route('orders.edit',$order)->withMessage('Orden modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->withMessage('Orden eliminada con éxito');
    }
}
