<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Alternative::all();
        return view('pages.alternative')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlternativeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'string',
        ]);

        Alternative::create([
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
        ]);

        return redirect()->back()->with(['message' => 'input data sukses']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // dd($request->name);
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'address' => 'string',
        ]);

        $data = Alternative::find($request->id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->contact = $request->contact;
        $data->save();

        return redirect()->back()->with(['message' => 'Update data sukses']);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $alternative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Alternative::find($id);
        $data->delete();
        return redirect()->back()->with(['message' => 'Delete data sukses']);

    }
}
