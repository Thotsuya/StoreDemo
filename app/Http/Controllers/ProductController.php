<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Procedure;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Products/Index',[
            'products' => Product::latest('id')->paginate(8)
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
        $product = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Product::create($product);

        return redirect()->route('products.index')->with('message', 'Producto registrado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit',[
            'product' => $product->load('factories'),
            'factories' => Factory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $updatedProduct = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'distributors.*.amount' => 'required_with:distributors.*.factory_id'
        ]);

        $product->update($updatedProduct);

        if($request->distributors){

            $product->factories()->detach();

            for($i=0;$i<count($request->distributors);$i++){

                $product->factories()->attach($request->distributors[$i]['factory_id'],[
                    'amount' => $request->distributors[$i]['amount']
                ]);

            }
        }

        return redirect()->route('products.edit',$product)->withMessage('Producto modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Producto eliminado exitosamente.');
    }
}
