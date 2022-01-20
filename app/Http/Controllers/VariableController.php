<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Variable;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($selected = null)
    {
        $criteria = Criteria::leftJoin('variables', 'criterias.id','=', 'variables.criteria_id')
                    ->leftJoin('surveys','criterias.id', '=', 'surveys.criteria_id')
                    ->select('criterias.*', 'variables.criteria_id', 'variables.alternative_id', 'variables.value as values', 'variables.id as variable_id' , 'surveys.path as image', 'surveys.detail as detail')->get();


        $data = (object)[
           'criteria'=> Criteria::all(),
           'mitra' => Alternative::all(),
           'selected' => $selected,
           'storedData' => $criteria
        ];
        return view('pages.variable')->with('data' , $data);
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
     * @param  \App\Http\Requests\StoreVariableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except(['_token', 'alternative']) as $criteria => $value) {
            Variable::updateOrCreate(
                [
                    'alternative_id' => $request->alternative,
                    'criteria_id' => $criteria
                ],
                ['value' => $value]
            );
        }

        return $this->index($request->alternative);
        return redirect()->back()->with(['message' => 'Input data sukses']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        return $this->index($request->data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function edit(Variable $variable)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVariableRequest  $request
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function update($request, Variable $variable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Variable::find($id);
        $data->delete();
        return redirect('variable');
    }
}
