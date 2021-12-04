<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Factories/Index',[
            'factories' => Factory::latest('id')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factory = $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);

        Factory::create($factory);
        return redirect()->route('factories.index')->withMessage('Fábrica registrada exitosamente');

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
    public function edit(Factory $factory)
    {
        return Inertia::render('Factories/Edit',[
            'factory' => $factory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factory $factory)
    {
        $updatedFactory = $request->validate([
            'name' => 'required',
            'phone_number' => 'required'
        ]);

        $factory->update($updatedFactory);
        return redirect()->route('factories.edit',$factory)->withMessage('Fábrica modificada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factory $factory)
    {
        $factory->delete();
        return redirect()->route('factories.index')->withMessage('Fábrica eliminada exitosamente');
    }
}
